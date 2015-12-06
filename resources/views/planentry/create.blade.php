@extends('base')

@section('content')
  <h1> Add Planentry</h1>
  <hr />
  {!! Form::open(['url' => 'planentry']) !!}
  @include ('planentry._form', ['submitButtonText' => 'Add'])
  {!! Form::close() !!}

  <br />
  @include ('errors.list')

@stop
