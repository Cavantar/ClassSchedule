<table class="table table-bordered">
  <thead><tr>
    <th> Id </th>
    <th> Name </th>
    <th> Surname </th>
    <th> Plan Name </th>
    <th> E-mail </th>
  </tr></thead>

  @foreach ($raw_data as $data)
    <tr>
      <td> {{ $data['id'] }} </td>
      <td> {{ $data['name'] }} </td>
      <td> {{ $data['surname'] }} </td>
      <td> {{ $data->plan['name'] }} </td>
      <td> {{ $data['email'] }} </td>

      @if (Session::get('admin'))
	<td>
	  {!! Form::open([
		      'method' => 'DELETE',
			'route' => ['student.destroy', $data['id']]
		      ]) !!}
	  <a href="{{ route('student.edit', $data['id']) }}" class="btn btn-primary">Edit</a>
	  {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
	  {!! Form::close() !!}
	</td>
      @endif
    </tr>
  @endforeach
</table>
@if (Session::get('admin'))
  <a href="{{ route('student.create') }}" class="btn btn-primary">Add</a>
@endif
