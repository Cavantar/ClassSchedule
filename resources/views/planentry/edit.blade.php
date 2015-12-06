@extends('base')

@section('content')
  <h1> Add Planentry</h1>
  <hr />
  {!! Form::model($planentry, ['method' => 'PATCH', 'action' => ['PlanEntryController@update', $planentry->id]]) !!}
  @include ('planentry._form', ['submitButtonText' => 'Update'])
  {!! Form::close() !!}

  <br />
  @include ('errors.list')

@stop
