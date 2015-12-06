<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schoolclass extends Model
{
  public $timestamps = false;
  protected $table = 'schoolclasses';
  protected $guarded = array();
}
