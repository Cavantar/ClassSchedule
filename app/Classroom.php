<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
  public $timestamps = false;
  protected $table = 'classrooms';
  protected $guarded = array();
}
