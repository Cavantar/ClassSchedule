<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Session;
use Redirect;

use App\Classroom;

class ClassroomController extends Controller
{
  private $validationArray = ['name' => 'required'];

  public function __construct()
  {
    $this->beforeFilter(function()
      {
	Session::put('intended_landing', "/classroom");

	if(Session::get('logged_in') == false)
	  return view('home/index');
	if(Session::get('user_type') == "student")
	  return Redirect::to("plan/" . Session::get('plan_id'));

      });
  }

  public function index()
  {
    //
    $datas = Classroom::all()->toArray();

    $viewData = array(
      'datas' => $datas,
	'controller' => $this
    );

    return view("classroom\index")->with($viewData);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
    return view("classroom.create");
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
    $this->validate($request, $this->validationArray);
    $input = $request->all();
    Classroom::create($input);

    return redirect('classroom');
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
    $classroom = Classroom::findOrFail($id);

    return view("classroom.edit", compact('classroom'));
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

    $classroom = Classroom::findOrFail($id);
    $input = $request->all();

    $classroom->update($input);

    return redirect('classroom');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $classroom = Classroom::findOrFail($id);
    $classroom->delete();

    return redirect()->route('classroom.index');
  }
}
