@extends('base')

@section('content')
  <h1> Edit Classroom</h1>
  <hr />
  {!! Form::model($schoolclass, ['method' => 'PATCH', 'action' => ['SchoolclassController@update', $schoolclass->id]]) !!}
  @include ('schoolclass._form', ['submitButtonText' => 'Update'])
  {!! Form::close() !!}

  <br />
  @include ('errors.list')

@stop
@include ('common\_tabSetter', ['tabName' => "schoolclass"])
