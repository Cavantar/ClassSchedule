@extends('base')

@section('content')
  <h1> Add Classroom</h1>
  <hr />
  {!! Form::model($classroom, ['method' => 'PATCH', 'action' => ['ClassroomController@update', $classroom->id]]) !!}
  @include ('classroom._form', ['submitButtonText' => 'Update'])
  {!! Form::close() !!}

  <br />
  @include ('errors.list')

@stop
@include ('common\_tabSetter', ['tabName' => "classroom"])
