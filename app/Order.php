<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
  protected $fillable = [
    'user_id', 'status'
  ];

  public function products()
  {
      return $this->belongsToMany('App\Product')->withPivot('amount', 'product_price');
  }
}
