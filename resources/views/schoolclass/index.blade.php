@extends('base')

@section('content')
  <h1> Schoolclass </h1>
  <br />

  @include ('common\_tableList', ['datas' => $datas, 'baseTable' => 'schoolclass'])

@stop
@include ('common\_tabSetter', ['tabName' => "schoolclass"])
