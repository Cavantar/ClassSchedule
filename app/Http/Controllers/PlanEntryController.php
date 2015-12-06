<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\PlanEntry;

use Session;

class PlanEntryController extends Controller
{
  private $validationArray = ['plan_id' => 'required', 'teacher_id' => 'required',
    'schoolclass_id' => 'required', 'classroom_id' => 'required', 'week_day' => 'required',
    'time_start' => 'required', 'time_end' => 'required'];

  public function __construct()
  {
    $this->beforeFilter(function()
      {
	Session::put('intended_landing', "/planentry");
	if(Session::get('logged_in') == false)
	  return view('home/index');
      });
  }

  public function index()
  {
    //

    $raw_data = PlanEntry::all();
    $datas = $raw_data->toArray();

    $viewData = array(
      'datas' => $datas,
	'raw_data' => $raw_data,
	'controller' => $this
    );

    return view("planentry\index")->with($viewData);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
    $viewData = [
      "controller" => $this
    ];

    return view("planentry.create")->with($viewData);
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

    $timeStart = $input['time_start'];
    $timeEnd = $input['time_end'];
    $week_day = $input['week_day'];

    $checkResult = $this->isCollidingWithExisting($input["plan_id"], $week_day, $timeStart, $timeEnd);

    if(!empty($checkResult))
    {
      Session::flash('msg', $checkResult);
      return Redirect::back()->withInput($input);
    }

    PlanEntry::create($input);
    return redirect('plan/' . $input["plan_id"]);
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
    $planentry = PlanEntry::findOrFail($id);

    $viewData = [
      "planentry" => $planentry,
	"controller" => $this,
    ];

    return view("planentry.edit", $viewData);
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
    $input = $request->all();

    $timeStart = $input['time_start'];
    $timeEnd = $input['time_end'];
    $week_day = $input['week_day'];

    $checkResult = $this->isCollidingWithExisting($input["plan_id"], $week_day, $timeStart, $timeEnd, $id);

    if(!empty($checkResult))
    {
      Session::flash('msg', $checkResult);
      return Redirect::back()->withInput($input);
    }

    $planentry = PlanEntry::findOrFail($id);
    $input = $request->all();

    $planentry->update($input);

    return redirect('plan/' . $planentry->plan_id);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $planentry = PlanEntry::findOrFail($id);
    $plan_id = $planentry["plan_id"];
    $planentry->delete();

    return redirect('plan/' . $plan_id);
  }
}
