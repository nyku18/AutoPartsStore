<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarBrand extends Model
{
  public $timestamps = false;

  public function models()
  {
      return $this->hasMany('App\CarModel');
  }
}
