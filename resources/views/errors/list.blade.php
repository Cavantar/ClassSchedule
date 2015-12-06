@if ($errors->any())
  <ul class="alert alert-danger" style="padding-left: 5%;">
    @foreach($errors->all() as $error)
      <li> {{ $error }}</li>
    @endforeach
  </ul>
@endif

@if(Session::has('msg'))
  <ul class="alert alert-danger" style="padding-left: 5%;">
    @foreach(Session::get('msg') as $msg)
      <li> {{ $msg }}</li>
    @endforeach

  </ul>
@endif
