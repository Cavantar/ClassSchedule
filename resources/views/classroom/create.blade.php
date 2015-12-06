@extends('base')

@section('content')
  <h1> Add Classroom</h1>
  <hr />
  {!! Form::open(['url' => 'classroom']) !!}
  @include ('classroom._form', ['submitButtonText' => 'Add'])
  {!! Form::close() !!}

  <br />
  @include ('errors.list')

@stop
@include ('common\_tabSetter', ['tabName' => "classroom"])
