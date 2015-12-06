<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
  //
  public $timestamps = false;
  protected $table = 'students';
  protected $guarded = array();

  public function plan()
  {
    return $this->belongsTo("App\Plan");
  }

}
