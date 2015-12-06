@extends('base')

@section('content')
  <h1> Planentrys </h1>
  <br />

  {{-- @include ('common\_tableList', ['datas' => $datas, 'baseTable' => 'planentry']) --}}
  @include ('planentry\_showlist', ['raw_data' => $raw_data])

@stop
