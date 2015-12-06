@extends('base')

@section('content')
  <h1> Add Teacher</h1>
  <hr />
  {!! Form::open(['url' => 'teacher']) !!}
  @include ('teacher._form', ['submitButtonText' => 'Add Teacher', 'isAdd' => true])
  {!! Form::close() !!}

  <br />
  @include ('errors.list')

@stop
@include ('common\_tabSetter', ['tabName' => "teacher"])
