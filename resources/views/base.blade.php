<!DOCTYPE html>
<html>
  <head>
    <title> Class Schedule </title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    <style>
    #retrievedNotifier{
      opacity: 0;
    };
    </style>

    @yield('script')

  </head>
  <body>
    <div class="container">
      <div class="jumbotron">
	<h1> Class Schedule </h1>

	@if (Session::get('logged_in'))
	  <h4> Logged In as: {{ Session::get('user_text')}}</h4>
	  <h5> Admin: {{ Session::get('admin') ? "true" : "False" }} </h5>
	  <a href="/logout" class="btn btn-primary btn-xs" role="button">Logout</a>
	@else
	  <h4> Logged Out </h4>
	@endif
      </div>
      <div class="well well-lg">
	<ul class="nav nav-tabs">
	  <li id="plan_tab"><a href="{{ URL::route('plan.index') }}">Plans</a></li>
	  <li id="student_tab"><a href="{{ URL::route('student.index') }}">Students</a></li>
	  <li id="teacher_tab"><a href="{{ URL::route('teacher.index') }}">Teachers</a></li>
	  <li id="classroom_tab"><a href="{{ URL::route('classroom.index') }}">Classrooms</a></li>
	  <li id="schoolclass_tab"><a href="{{ URL::route('schoolclass.index') }}">Schoolclasses</a></li>
	</ul>
	<div class="tab-content">
	  <br/>
	  <br/>
	  <div id="content">
	    @yield('content')
	    <br />
	    <hr>
	  </div>
	</div>
      </div>
    </div>
  </body>
</html>
