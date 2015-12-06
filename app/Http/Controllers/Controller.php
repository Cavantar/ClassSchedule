<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Plan;
use App\PlanEntry;
use App\Teacher;
use App\Schoolclass;
use App\Classroom;

abstract class Controller extends BaseController
{
  use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

  private $indexedDays = ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"];

  public function getDays() { return $this->indexedDays; }
  public function getDayDropDown()
  {
    $i = 0;
    $dropDownArray = array();

    foreach($this->indexedDays as $day)
    {
      $dropDownArray[$i] = $day;
      $i++;
    }

    return $dropDownArray;
  }

  public function getFloatTime($time)
  {
    $times = explode(':',$time);

    $hour  = intval($times[0]);
    $minutes = intval($times[1]);

    return $hour + ($minutes / 60.0);
  }

  public function isCollidingWithExisting($plan_id, $week_day, $timeStart, $timeEnd, $current_pe_id = -1)
  {
    $timeStartF = $this->getFloatTime($timeStart);
    $timeEndF = $this->getFloatTime($timeEnd);

    $result = [];
    if($timeStartF == $timeEndF)
    {
      array_push($result, "Time Start and Time End can't be the same");
    }

    if($timeEndF < $timeStartF)
    {
      array_push($result, "Time End is before Time Start");
    }

    $plan_entries = PlanEntry::where('plan_id', '=', $plan_id)->get();

    foreach($plan_entries as $entry)
    {
      if($week_day == $entry['week_day'] && ($current_pe_id == -1 || $entry['id'] != $current_pe_id))
      {
	$timeStartTF = $entry['time_start'];
	$timeEndTF = $entry['time_end'];

	if(!($timeStartF >= $timeEndTF || $timeEndF <= $timeStartTF))
	{
	  // There's collision in the plan
	  $error = "";
	  $error .= "Collided With PlanEntry". "(id: ". $entry['id'] . ") " . $entry->schoolclass["name"] . " ";
	  $error .= "(" . $entry['time_start'] . " - " . $entry['time_end'] . ")";

	  array_push($result, $error);

	  break;
	}
      }
    }

    return $result;
  }

  public function getPlanDropDown()
  {
    $plans = Plan::all();


    foreach($plans as $plan)
      $dropDownArray[$plan['id']] = $plan['name'];

    return $dropDownArray;
  }

  public function getTeacherDropDown()
  {
    $datas = Teacher::all();
    $dropDownArray = array();

    foreach($datas as $data)
      $dropDownArray[$data['id']] = $data['name'] . " " . $data['surname'];

    return $dropDownArray;
  }

  public function getSchoolclassDropDown()
  {
    $datas = Schoolclass::all();
    $dropDownArray = array();

    foreach($datas as $data)
      $dropDownArray[$data['id']] = $data['name'] . " (" . $data['hour_count'] . ")";

    return $dropDownArray;
  }

  public function getClassroomDropDown()
  {
    $datas = Classroom::all();
    $dropDownArray = array();

    foreach($datas as $data)
      $dropDownArray[$data['id']] = $data['name'];

    return $dropDownArray;
  }

  public function getHourDropDown()
  {
    $dropDownArray = array();

    for($i = 8; $i <= 20; $i++)
    {
      $hour = sprintf("%02d", $i);

      for($j = 0; $j < 2; $j++)
      {
	if($i == 20 && $j == 1) continue;
	$minutes = sprintf("%02d", ($j == 0 ? 0 : 30));
	$resultTime = $hour . ":"  . $minutes;

	$dropDownArray[$resultTime . ":00"] = $resultTime;
      }
    }

    return $dropDownArray;
  }

  public function clmNameFromDb($clmName)
  {
    $result = str_replace(["_"], [" "], $clmName);
    $result = ucwords($result);
    return $result;
  }

  public function htmlTableFromObject($assoc_arr)
  {
    $result = "";
    $result .= '<table class="table">';

    if(count($assoc_arr) > 0)
    {
      $result .= '<thead><tr>';
      foreach($assoc_arr[0] as $key=>$row) {
	$result .= "<th>" . ($this->clmNameFromDb($key)) . "</th>";
      }
      $result .= '</thead></tr>';
    }

    foreach($assoc_arr as $key=>$row) {
      $result .= "<tr>";
      foreach($row as $key2=>$row2){
	$result .= "<td>" . $row2 . "</td>";
      }
      $result .= "</tr>";
    }
    $result .= "</table>";

    return $result;
  }
}
