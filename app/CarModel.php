<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
  public $timestamps = false;

  public function brand()
  {
      return $this->belongsTo('App\CarBrand');
  }

  public function products()
  {
      return $this->hasMany('App\Product');
  }
}
