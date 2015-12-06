<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Session;
use Redirect;

use App\Schoolclass;

class SchoolclassController extends Controller
{
  private $validationArray = ['name' => 'required', 'hour_count' => 'required'];

  public function __construct()
  {
    $this->beforeFilter(function()
      {
	Session::put('intended_landing', "/schoolclass");

	if(Session::get('logged_in') == false)
	  return view('home/index');

	if(Session::get('user_type') == "student")
	  return Redirect::to("plan/" . Session::get('plan_id'));
      });
  }

  public function index()
  {
    //
    $datas = Schoolclass::all()->toArray();

    $viewData = array(
      'datas' => $datas,
	'controller' => $this
    );

    return view("schoolclass\index")->with($viewData);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
    return view("schoolclass.create");
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
    Schoolclass::create($input);

    return redirect('schoolclass');
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
    $schoolclass = Schoolclass::findOrFail($id);

    return view("schoolclass.edit", compact('schoolclass'));
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

    $schoolclass = Schoolclass::findOrFail($id);
    $input = $request->all();

    $schoolclass->update($input);

    return redirect('schoolclass');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $schoolclass = Schoolclass::findOrFail($id);
    $schoolclass->delete();

    return redirect()->route('schoolclass.index');
  }
}
