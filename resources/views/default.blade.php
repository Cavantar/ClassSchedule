@extends('base')

@section('content')
  <h1> Things </h1>
  <br />
  {{--  @include ('common\_tableList', ['datas' => $datas, 'baseTable' => 'plan']) --}}

  <a href="{{ URL::route('student.index') }}" class="btn btn-primary" role="button"> Students </a>
  <a href="{{ URL::route('teacher.index') }}" class="btn btn-primary" role="button"> Teachers </a>
  <a href="{{ URL::route('classroom.index') }}" class="btn btn-primary" role="button"> Classrooms </a>
  <a href="{{ URL::route('schoolclass.index') }}" class="btn btn-primary" role="button"> Schoolclasses </a>
  <a href="{{ URL::route('plan.index') }}" class="btn btn-primary" role="button"> Plans </a>
  <a href="{{ URL::route('planentry.index') }}" class="btn btn-primary" role="button"> PlanEntries </a>

@stop
