@extends('base')

@section('content')
  <h1> Plans </h1>
  <br />

  <table class="table table-bordered">
    <thead><tr>
      <th> Id </th>
      <th> Name </th>
    </tr></thead>
    @foreach ($raw_data as $data)
      <tr>
	<td> {{ $data['id'] }} </td>
	<td> {{ $data['name'] }} </td>

	<td>
	  @if (Session::get('admin'))

	    {!! Form::open([
			'method' => 'DELETE',
			  'route' => ['plan.destroy', $data['id']]
			]) !!}
	    <a href="{{ route('plan.show', $data['id']) }}" class="btn btn-info">Show</a>
	    <a href="{{ route('plan.edit', $data['id']) }}" class="btn btn-primary">Edit</a>
	    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
	    {!! Form::close() !!}
	  @else
	    <a href="{{ route('plan.show', $data['id']) }}" class="btn btn-info">Show</a>
	@endif
	</td>
      </tr>
    @endforeach

  </table>
  @if (Session::get('admin'))
    <a href="{{ route('plan.create') }}" class="btn btn-primary">Add</a>
  @endif

@stop

@include ('common\_tabSetter', ['tabName' => "plan"])
