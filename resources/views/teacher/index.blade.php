@extends('base')

@section('content')
  <h1> Teachers </h1>
  <br />

  <table class="table table-bordered">
    <thead><tr>
      <th> Id </th>
      <th> Name </th>
      <th> Surname </th>
      <th> E-mail </th>
      <th> Admin </th>
    </tr></thead>

    @foreach ($datas as $data)
      <tr>
	<td> {{ $data['id'] }} </td>
	<td> {{ $data['name'] }} </td>
	<td> {{ $data['surname'] }} </td>
	<td> {{ $data['email'] }} </td>
	<td> {{ $data['admin'] == "1" ? "true" : "false"}} </td>

	@if (Session::get('admin'))
	  <td>
	    {!! Form::open([
			'method' => 'DELETE',
			  'route' => ['teacher.destroy', $data['id']]
			]) !!}
	    <a href="{{ route('teacher.edit', $data['id']) }}" class="btn btn-primary">Edit</a>
	    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
	    {!! Form::close() !!}
	  </td>
	@endif

      </tr>
    @endforeach
  </table>
  @if (Session::get('admin'))
    <a href="{{ route('teacher.create') }}" class="btn btn-primary">Add</a>
  @endif


@stop
@include ('common\_tabSetter', ['tabName' => "teacher"])
