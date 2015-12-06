<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Session;
use Redirect;

use App\Plan;

class PlanController extends Controller
{
  // private $validationArray = ['name' => 'required', 'surname' => 'required'];
  private $validationArray = [];

  public function __construct()
  {
    $this->beforeFilter(function()
      {
	Session::put('intended_landing', "/plan");

	if(Session::get('logged_in') == false)
	  return view('home.index');

      });
  }

  public function index()
  {
    //
    if(Session::get('user_type') == "student")
      return Redirect::to("plan/" . Session::get('plan_id'));

    $raw_data = Plan::all();
    $datas = $raw_data->toArray();

    $viewData = array(
      'datas' => $datas,
	'raw_data' => $raw_data,
	'controller' => $this
    );

    return view("plan\index")->with($viewData);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
    return view("plan.create");
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
    Plan::create($input);

    return redirect('plan');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $plan = Plan::findOrFail($id);
    $viewData = [
      "plan" => $plan,
	"controller" => $this,
    ];

    return view("plan.show")->with($viewData);
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
    $plan = Plan::findOrFail($id);

    return view("plan.edit", compact('plan'));
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

    $plan = Plan::findOrFail($id);
    $input = $request->all();

    $plan->update($input);

    return redirect('plan');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $plan = Plan::findOrFail($id);
    $plan->delete();

    return redirect()->route('plan.index');
  }
}
