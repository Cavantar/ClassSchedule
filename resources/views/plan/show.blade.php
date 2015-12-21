@extends('base')

@section('content')
  <h1> Plan:  </h1>
  <h2>{{ $plan["name"] }}</h2>

  <table class="table table-bordered">
    <thead><tr>
      <th>Time/Day</th>
      @foreach ($controller->getDays() as $day)
	<th>
	  {{ $day }}
	</th>
      @endforeach
    </tr></thead>
    @for ($i = 8; $i < 20; $i++)
      @for ($j = 0; $j < 2; $j++)

	<tr>
	  <td>
	    @if ($j == 0)
	      {{sprintf("%02d",$i) . ":00"}}
	      -
	      {{sprintf("%02d",$i) . ":30"}}

	    @else
	      {{sprintf("%02d",$i) . ":30"}}
	      -
	      {{sprintf("%02d",($i+1)) . ":00"}}
	    @endif

	  </td>
	  @for ($clm = 0; $clm < 7; $clm++)
	    {{-- */ $fieldIdentifier = "t" .$clm ."x".($j + (($i - 8) * 2));/* --}}
	    <td id="{{ $fieldIdentifier }}"
		    @if (Session::get('admin'))
		    onclick="addEntry('{{ $fieldIdentifier }}')"
		    onmouseenter="setRandomColor('{{ $fieldIdentifier }}')"
		    onmouseleave="resetColor('{{ $fieldIdentifier }}')"
		    @endif
		    > </td>
	  @endfor
	</tr>

      @endfor
    @endfor
  </table>

  <br />
  <h2>Plan Entries</h2>
  @include ('planentry\_showlist', ['raw_data' => $plan->planentries])

  {{ Session::put('plan_id', $plan["id"]) }}

  <h2>Attending Students</h2>
  @include ('student\_showlist', ['raw_data' => $plan->student])

@stop


@section('script')

  <script>

  var isAdmin = {{Session::get('admin') ? "true" : "false"}};
  var entries = [
    @foreach ($plan->planentries as $entry)
    {
      id:"{{ $entry["id"]}}",
      edit_path: "{{ route('planentry.edit', $entry['id'])}}",
      entry_form: "{{ Form::open([
		    'method' => 'DELETE',
		      'route' => ['planentry.destroy', $entry['id']]
		    ]) }}{{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}{{ Form::close() }}",
      teachersName:"{{ $entry->teacher["name"] . $entry->teacher["surname"] }}",
      className: "{{ $entry->schoolclass["name"] }}",
      classRoom: "{{ $entry->classroom["name"] }}",
      day: "{{ $entry["week_day"] }}",
      hour_count: "{{ $entry->schoolclass["hour_count"] }}",
      timeStart: "{{ $entry["time_start"] }}",
      timeEnd: "{{ $entry["time_end"] }}"
    },
    @endforeach
  ];

  var dayArray = [];
  @foreach ($controller->getDays() as $day)
  dayArray.push("{{ $day }}");
  @endforeach

  function parseTime(timeString)
  {
    timeArr = timeString.split(':');

    return {
      hour:parseInt(timeArr[0]),
      minutes:parseInt(timeArr[1]),
      seconds:parseInt(timeArr[2])
    };
  }

  function randomColor()
  {
    return "rgb(" + parseInt(Math.random()*255)+", "+parseInt(Math.random()*255)+", "+parseInt(Math.random()*255) + ")";
  }

  function padZerosTwo(value)
  {
    return value > 9 ? value.toString() : 0 + value.toString();
  }

  function addEntry(cellIdentifier)
  {
    identifierValues = cellIdentifier.substr(1, cellIdentifier.length - 1);
    valueIndexes = identifierValues.split("x");

    column = parseInt(valueIndexes[0]);
    row = parseInt(valueIndexes[1]);

    timeStart = 8 + (0.5 * row);

    timeStartString = getTimeString(timeStart);
    timeEndString = getTimeString(timeStart + 0.5);

    day = dayArray[column];

    window.location.replace("/planentry/create?time_start=" + timeStartString + "&time_end=" + timeEndString + "&day=" + column);
  }

  function getTimeString(number)
  {
    var resultValue = "";
    resultValue = padZerosTwo(Math.floor(number));
    resultValue += ":";
    resultValue += padZerosTwo((number % 1.0) * 60);
    resultValue += ":00";
    return resultValue;
  }

  function setRandomColor(cellIdentifier)
  {
    bgcolor = randomColorHex();
    $("#" + cellIdentifier).css("background-color", "#" + bgcolor);
  }

  function resetColor(cellIdentifier)
  {
    $("#" + cellIdentifier).css("background-color", "#f5f5f5");
  }

  function hexDigitFromDec(value)
  {
    if(value < 10) return value;
    return String.fromCharCode("A".charCodeAt(0) + (value - 10));
  }

  function numberToHex(number)
  {
    result = "";
    while(number > 0)
    {
      intValue = number % 16;
      number = parseInt(number / 16);
      digit = hexDigitFromDec(parseInt(intValue));
      result = digit + result;
    }
    return result;
  }

  function getHexColorValue()
  {
    result = numberToHex(Math.random()*255);
    if(result.length == 1) result = "0" + result;
    return result;
  }

  function randomColorHex()
  {
    return getHexColorValue() + getHexColorValue() + getHexColorValue();
  }

  function setCell(x, y, data, rowSpan)
  {
    cell_id = x + "x" + y;
    console.log("#t" + cell_id);
    $("#t" + cell_id).html(data);
    $("#t" + cell_id).attr("rowspan", rowSpan.toString());

    bgcolor = randomColorHex();
    fontcolor = (parseInt(bgcolor, 16) > 0xffffff/2) ? 'black':'white';

    $("#t" + cell_id).css("background-color", "#" + bgcolor);
    $("#t" + cell_id).css("color", fontcolor);
    $("#t" + cell_id).removeAttr("onmouseenter");
    $("#t" + cell_id).removeAttr("onmouseleave");
    $("#t" + cell_id).removeAttr("onclick");

    for(j = 1; j < rowSpan; j++)
    {
      cell_id = x + "x" + (y+j);
      $("#t" + cell_id).remove();
    }
  }

  function htmlDecode(value){
    return $('<div/>').html(value).text();
  }

  $(document).ready(function() {
    $("#plan_tab").addClass("active");
    for (i = 0; i < entries.length; i++) {
      entry = entries[i];
      cell_x = entry["day"];

      start_time = parseTime(entry["timeStart"]);
      end_time = parseTime(entry["timeEnd"]);

      duration = (end_time["hour"] - start_time["hour"]) * 2;
      cell_y = (start_time["hour"] - 8) * 2;

      if(start_time["minutes"] != 0)
      {
	duration--;
	cell_y++;
      }
      if(end_time["minutes"] != 0) duration += 1;

      cell_contents = entry["className"] + " (" + entry["hour_count"] + "h)<br />";
      cell_contents += "Classroom: " + entry["classRoom"] + "<br />";
      cell_contents += "Teacher: " + entry["teachersName"] + "<br />";

      if(isAdmin)
      {
	cell_contents += "<br /><a href=\"" + entry["edit_path"] + "\" class=\"btn btn-primary\">Edit</a>";
	cell_contents += htmlDecode(entry["entry_form"]);
      }

      setCell(cell_x, cell_y, cell_contents, duration);
    }
  })
  </script>
@stop
