<div class="form-group">
  {!! Form::label('plan_Name:') !!}
  {!! Form::select('plan_id', $controller->getPlanDropDown(), Session::get('plan_id'), ["class" => 'form-control']) !!}
</div>

<div class="form-group">
  {!! Form::label('teacher') !!}
  {!! Form::select('teacher_id', $controller->getTeacherDropDown(), null, ["class" => 'form-control']) !!}
</div>

<div class="form-group">
  {!! Form::label('schoolclass: ') !!}
  {!! Form::select('schoolclass_id', $controller->getSchoolclassDropDown(), null, ["class" => 'form-control']) !!}
</div>

<div class="form-group">
  {!! Form::label('classroom') !!}
  {!! Form::select('classroom_id', $controller->getClassroomDropDown(), null, ["class" => 'form-control']) !!}
</div>

<div class="form-group">
  {!! Form::label('week_day') !!}
  {!! Form::select('week_day', $controller->getDayDropDown(), (Input::get('day') != "" ? Input::get('day') : null), ["class" => 'form-control']) !!}
</div>

<div class="form-group">
  {!! Form::label('time_start') !!}
  {!! Form::select('time_start', $controller->getHourDropDown(), (Input::get('time_start') != "" ? Input::get('time_start') : null), ["class" => 'form-control']) !!}
</div>

<div class="form-group">
  {!! Form::label('time_end') !!}
  {!! Form::select('time_end', $controller->getHourDropDown(), (Input::get('time_end') != "" ? Input::get('time_end') : null), ["class" => 'form-control']) !!}
</div>

<div class="form-group">
  {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control']) !!}
</div>
