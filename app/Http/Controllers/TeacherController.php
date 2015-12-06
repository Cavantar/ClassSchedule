<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Session;
use Redirect;
use Hash;

use App\Teacher;


class TeacherController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */

  private $validationArray = ['name' => 'required', 'surname' => 'required', 'email' => 'required', 'admin' => 'required'];

  public function __construct()
  {
    $this->beforeFilter(function()
      {
	Session::put('intended_landing', "/teacher");

	if(Session::get('logged_in') == false)
	  return view('home/index');

	if(Session::get('user_type') == "student")
	  return Redirect::to("plan/" . Session::get('plan_id'));
      });
  }

  public function index()
  {
    //
    $datas = Teacher::all()->toArray();

    $viewData = array(
      'datas' => $datas,
	'controller' => $this
    );

    return view("teacher\index")->with($viewData);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
    return view("teacher.create");
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
    $this->validate($request, $this->validationArray + ['new_password' => 'required']);
    $input = $request->all();
    $input["password"] = Hash::make($input['new_password']);

    unset($input['new_password']);

    Teacher::create($input);

    return redirect('teacher');
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
    $teacher = Teacher::findOrFail($id);

    return view("teacher.edit", compact('teacher'));
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
    //
    $this->validate($request, $this->validationArray);

    $teacher = Teacher::findOrFail($id);
    $input = $request->all();
    if($input['new_password'] != "")
    {
      $input["password"] = Hash::make($input['new_password']);
    }
    unset($input['new_password']);
    $teacher->update($input);

    return redirect('teacher');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $teacher = Teacher::findOrFail($id);
    $teacher->delete();

    return redirect()->route('teacher.index');
  }
}
