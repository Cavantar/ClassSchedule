@extends('base')

@section('content')
  <h1> Edit Student</h1>
  <hr />
  {!! Form::model($student, ['method' => 'PATCH', 'action' => ['StudentController@update', $student->id]]) !!}
  @include ('student._form', ['submitButtonText' => 'Edit Student', 'isAdd' => false])
  {!! Form::close() !!}

  <br />
  @include ('errors.list')

@stop
@include ('common\_tabSetter', ['tabName' => "student"])
