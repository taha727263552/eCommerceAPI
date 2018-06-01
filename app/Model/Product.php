<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $fillable =[
        'name', 'stock', 'discount', 'detail', 'price'
    ];

    public function reviews()
    {
        return $this->hasMany('App\Model\Review', 'product_id', 'id');
    }
}
