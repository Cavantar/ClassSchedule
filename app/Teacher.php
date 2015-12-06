<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
  //
  public $timestamps = false;
  protected $table = 'teachers';
  protected $guarded = array();

  public function plan()
  {
    return $this->hasMany('App\Plan');
  }
}
