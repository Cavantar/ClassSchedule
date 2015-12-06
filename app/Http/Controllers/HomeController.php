<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Redirect;
use Session;
use Hash;

use App\Teacher;
use App\Student;


class HomeController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function getIndex()
  {
    $loggedIn = Session::get('logged_in');
    if($loggedIn)
      return  Redirect::to("plan");
    else
      return view('home/index');
  }

  public function postIndex(Request $request)
  {
    $input = $request->all();

    $email = $input['email'];
    $password = $input['password'];

    // Checking Teachers for appropriate logging data

    $teacher = Teacher::where('email', '=', $email)->first();
    $failText = "<h2>NULL</h2>";

    if($teacher)
    {
      if(Hash::check($password, $teacher['password']))
      {
	// Teacher logged in
	Session::put('logged_in', true);
	Session::put('user_type', "teacher");
	Session::put('admin', $teacher['admin']);
	Session::put('user_text', $teacher['name'] . " " . $teacher['surname'] . " (teacher)");

	return Redirect::to(Session::get('intended_landing'));
	return Redirect::intended('/');
	return "Logged in as teacher !";
      }
      else
      {
	return Redirect::back()
	  ->withInput()
	  ->withErrors('That username/password combo does not exist.');
	return "Wrong Password(teacher)";
      }
    }
    else
    {
      // Checking if user would be correct
      $student = Student::where('email', '=', $email)->first();
      if($student)
      {
	if(Hash::check($password, $student['password']))
	{
	  Session::put('logged_in', true);
	  Session::put('user_type', "student");
	  Session::put('plan_id', $student['plan_id']);
	  Session::put('admin', false);
	  Session::put('user_text', $student['name'] . " " . $student['surname']. " (student)");

	  // return Session::get('intended_landing');
	  return Redirect::to("plan/" . $student['plan_id']);
	  return Redirect::intended('/');
	  return "Logged in as student";
	}
	else
	{
	  return Redirect::back()
	    ->withInput()
	    ->withErrors('That username/password combo does not exist.');
	  return "Wrong Password(student)";
	}
      }
      else
      {
	return Redirect::back()
	  ->withInput()
	  ->withErrors('That username/password combo does not exist.');
	return "Wrong Username";
      }
    }
  }

  public function getLogin()
  {
    return Redirect::to('/');
  }

  public function getLogout()
  {
    Session::put('logged_in', false);
    return Redirect::to('/');
  }

}
