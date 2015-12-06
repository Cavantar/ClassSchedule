@extends('base')

@section('content')
  <h1> Add Schoolclass</h1>
  <hr />
  {!! Form::open(['url' => 'schoolclass']) !!}
  @include ('schoolclass._form', ['submitButtonText' => 'Add'])
  {!! Form::close() !!}

  <br />
  @include ('errors.list')

@stop

@include ('common\_tabSetter', ['tabName' => "schoolclass"])
