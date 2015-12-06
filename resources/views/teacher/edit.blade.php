@extends('base')

@section('content')
  <h1> Edit Teacher</h1>
  <hr />
  {!! Form::model($teacher, ['method' => 'PATCH', 'action' => ['TeacherController@update', $teacher->id]]) !!}
  @include ('teacher._form', ['submitButtonText' => 'Update Teacher', 'isAdd' => false])
  {!! Form::close() !!}

  <br />
  @include ('errors.list')

@stop
@include ('common\_tabSetter', ['tabName' => "teacher"])
