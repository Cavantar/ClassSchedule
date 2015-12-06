<table class="table table-bordered">
  <thead><tr>
    @foreach ($datas[0] as $key=>$row)
      <th>
	{{ $controller->clmNameFromDb($key) }}
      </th>
    @endforeach
  </tr></thead>

  @foreach ($datas as $data)
    <tr>
      @foreach ($data as $key=>$row)
	<td>
	  {{ $row }}
	</td>
      @endforeach

      @if (Session::get('admin'))
	<td>
	  {!! Form::open([
		      'method' => 'DELETE',
			'route' => [$baseTable . '.destroy', $data['id']]
		      ]) !!}
	  <a href="{{ route($baseTable . '.edit', $data['id']) }}" class="btn btn-primary">Edit</a>
	  {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
	  {!! Form::close() !!}
	</td>
      @endif
    </tr>
  @endforeach
</table>
@if (Session::get('admin'))
  <a href="{{ route($baseTable . '.create') }}" class="btn btn-primary">Add</a>
@endif
