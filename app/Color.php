<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function Product(){
        return $this->belongsToMany(Product::class, 'product_color', 'color_id', 'product_id');
    }
    public function Cart(){
        return $this->hasMany(Cart::class );
    }
}
