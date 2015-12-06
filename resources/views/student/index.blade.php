@extends('base')

@section('content')
  <h1> Students </h1>
  <br />

  @include ('student\_showlist', ['raw_data' => $raw_data])

@stop
@include ('common\_tabSetter', ['tabName' => "student"])
