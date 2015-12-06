@extends('base')

@section('content')
  <h1> Classrooms </h1>
  <br />

  @include ('common\_tableList', ['datas' => $datas, 'baseTable' => 'classroom'])
@stop
@include ('common\_tabSetter', ['tabName' => "classroom"])
