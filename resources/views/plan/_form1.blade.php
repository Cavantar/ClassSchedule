<div class="form-group">
  {!! Form::label('plan_id', "plan_id: ") !!}
  {!! Form::text('plan_id', null, ["class" => 'form-control']) !!}
</div>

<div class="form-group">
  {!! Form::label('teacher_id', "teacher_id: ") !!}
  {!! Form::text('teacher_id', null, ["class" => 'form-control']) !!}
</div>

<div class="form-group">
  {!! Form::label('schoolclass_id: ') !!}
  {!! Form::text('schoolclass_id', null, ["class" => 'form-control']) !!}
</div>

<div class="form-group">
  {!! Form::label('classroom_id', "classroom_id: ") !!}
  {!! Form::text('classroom_id', null, ["class" => 'form-control']) !!}
</div>

<div class="form-group">
  {!! Form::label('week_day', "week_day: ") !!}
  {!! Form::text('week_day', null, ["class" => 'form-control']) !!}
</div>

<div class="form-group">
  {!! Form::label('time_start', "time_start: ") !!}
  {!! Form::text('time_start', null, ["class" => 'form-control']) !!}
</div>

<div class="form-group">
  {!! Form::label('time_start', "time_start: ") !!}
  {!! Form::text('time_start', null, ["class" => 'form-control']) !!}
</div>

<div class="form-group">
  {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control']) !!}
</div>
