<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Student;
use App\Plan;

use Session;
use Redirect;
use Hash;

class StudentController extends Controller
{
  private $validationArray = ['name' => 'required', 'surname' => 'required', 'plan_id' => 'required', 'email' => 'required'];

  public function __construct()
  {
    $this->beforeFilter(function()
      {
	Session::put('intended_landing', "/student");
	if(Session::get('logged_in') == false)
	  return view('home/index');

	if(Session::get('user_type') == "student")
	  return Redirect::to("plan/" . Session::get('plan_id'));
      });
  }

  public function index()
  {
    //
    $raw_data = Student::all();
    $datas = $raw_data->toArray();

    $viewData = array(
      'raw_data' => $raw_data,
	'datas' => $datas,
	'controller' => $this
    );

    return view("student\index")->with($viewData);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */

  public function create()
  {
    //

    // return print_r($dropDownArray);
    $viewData = array(
      'controller' => $this
    );
    return view("student.create")->with($viewData);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    //
    // return $request->all()['plan_name'];
    $this->validate($request, $this->validationArray + ['new_password' => 'required']);
    $input = $request->all();
    $input['password'] = Hash::make($input['new_password']);
    unset($input['new_password']);

    Student::create($input);

    return redirect('student');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    //
    $student = Student::findOrFail($id);

    // return print_r($dropDownArray);
    $viewData = array(
      'controller' => $this,
	'student' => $student
    );
    // return view("student.create")->with($viewData);
    return view("student.edit")->with($viewData);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $this->validate($request, $this->validationArray);

    $student = Student::findOrFail($id);
    $input = $request->all();

    $new_password = $input["new_password"];
    if($new_password != "")
    {
      $input["password"] = Hash::make($new_password);
    }
    unset($input['new_password']);

    $student->update($input);

    return redirect('student');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $student = Student::findOrFail($id);
    $student->delete();

    return redirect()->route('student.index');
  }
}
