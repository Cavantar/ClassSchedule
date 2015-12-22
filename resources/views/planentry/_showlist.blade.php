<table class="table table-bordered">
  <thead><tr>
    <th> Id </th>
    <th> Plan </th>
    <th> Teacher </th>
    <th> Schoolclass </th>
    <th> Classroom </th>
    <th> Weekday </th>
    <th> TimeStart </th>
    <th> TimeEnd </th>
  </tr></thead>

  @foreach ($raw_data as $data)
    <tr>
      <td> {{ $data['id'] }} </td>
      <td> {{ $data->plan['name'] }} </td>
      <td> {{ $data->teacher['name'] . " " . $data->teacher['surname']}} </td>
      <td> {{ $data->schoolclass['name'] . " (" .  $data->schoolclass['hour_count'] . "h)" }} </td>
      <td> {{ $data->classroom['name'] }} </td>
      <td> {{ $data->getWeekdayString() }} </td>
      <td> {{ $data['time_start'] }} </td>
      <td> {{ $data['time_end'] }} </td>
      @if (Session::get('admin'))
	<td>
	  {!! Form::open([
		      'method' => 'DELETE',
			'route' => ['planentry.destroy', $data['id']]
		      ]) !!}
	  <a href="{{ route('planentry.edit', $data['id']) }}" class="btn btn-primary">Edit</a>
	  {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
	  {!! Form::close() !!}
	</td>
      @endif
    </tr>
  @endforeach
</table>
@if (Session::get('admin'))
  <a href="{{ route('planentry.create') }}" class="btn btn-primary">Add</a>
@endif
