@extends('base')

@section('content')
  <h1> Add Plan</h1>
  <hr />
  {!! Form::model($plan, ['method' => 'PATCH', 'action' => ['PlanController@update', $plan->id]]) !!}
  @include ('plan._form', ['submitButtonText' => 'Update Plan'])
  {!! Form::close() !!}

  <br />
  @include ('errors.list')

@stop
@include ('common\_tabSetter', ['tabName' => "plan"])
