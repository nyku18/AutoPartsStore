<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
      'user_id', 'model_id', 'category_id', 'title', 'description', 'stock', 'price', 'original', 'photo'
    ];

    public function model()
    {
        return $this->belongsTo('App\CarModel');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function carts()
    {
        return $this->belongsToMany('App\Cart')->withPivot('amount');
    }

    public function orders()
    {
        return $this->belongsToMany('App\Order')->withPivot('amount', 'product_price');
    }
}
