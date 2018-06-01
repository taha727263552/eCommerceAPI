<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $fillable =[
        'name', 'stock', 'discount', 'detail', 'price', 'user_id'
    ];

    // protected $hidden = [
    //     'user_id'
    // ];

    public function reviews()
    {
        return $this->hasMany('App\Model\Review', 'product_id', 'id');
    }
}
