@extends('base')

@section('content')
  <h1> Add Student</h1>
  <hr />
  {!! Form::open(['url' => 'student']) !!}
  @include ('student._form', ['submitButtonText' => 'Add Student', 'isAdd' => true])

  {!! Form::close() !!}

  <br />
  @include ('errors.list')

@stop
@include ('common\_tabSetter', ['tabName' => "student"])
