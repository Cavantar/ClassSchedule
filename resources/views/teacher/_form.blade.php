<div class="form-group">
  {!! Form::label('name:') !!}
  {!! Form::text('name', null, ["class" => 'form-control']) !!}
</div>

<div class="form-group">
  {!! Form::label('surname:') !!}
  {!! Form::text('surname', null, ["class" => 'form-control']) !!}
</div>

<div class="form-group">
  {!! Form::label('email:') !!}
  {!! Form::text('email', null, ["class" => 'form-control']) !!}
</div>

<div class="form-group">
  {!! Form::label((!$isAdd ? "new_password (Non empty to change)": "Password")) !!}
  {!! Form::text('new_password', null, ["class" => 'form-control']) !!}
</div>

<div class="form-group">
  {!! Form::label('admin:') !!}
  {!! Form::select('admin', ["0" => "false", "1" => "true"],null, ["class" => 'form-control']) !!}
</div>

<div class="form-group">
  {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control']) !!}
</div>
