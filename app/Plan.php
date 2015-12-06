<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
  //
  public $timestamps = false;
  protected $table = 'plans';
  protected $guarded = array();

  public function teacher()
  {
    return $this->belongsTo('App\Teacher');
  }

  public function schoolclass()
  {
    return $this->belongsTo('App\Schoolclass');
  }

  public function classroom()
  {
    return $this->belongsTo('App\Classroom');
  }

  public function student()
  {
    return $this->hasMany('App\Student');
  }

  public function planentries()
  {
    return $this->hasMany('App\Planentry');
  }
}
