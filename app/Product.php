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
}
