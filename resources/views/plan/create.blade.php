@extends('base')

@section('content')
  <h1> Add Plan</h1>
  <hr />
  {!! Form::open(['url' => 'plan']) !!}
  @include ('plan._form', ['submitButtonText' => 'Add Plan'])
  {!! Form::close() !!}

  <br />
  @include ('errors.list')

@stop
@include ('common\_tabSetter', ['tabName' => "plan"])
