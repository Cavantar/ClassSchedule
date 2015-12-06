<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlanEntry extends Model
{
  //
  public $timestamps = false;
  protected $table = 'plan_entries';
  protected $guarded = array();
  private $indexedDays = ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"];

  public function plan()
  {
    return $this->belongsTo("App\Plan");
  }

  public function teacher()
  {
    return $this->belongsTo("App\Teacher");
  }

  public function schoolclass()
  {
    return $this->belongsTo("App\Schoolclass");
  }

  public function classroom()
  {
    return $this->belongsTo("App\Classroom");
  }

  public function getWeekdayString()
  {
    return $this->indexedDays[$this['week_day']];
  }

}
