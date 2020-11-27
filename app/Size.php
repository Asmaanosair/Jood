<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $hidden = [
        'created_at', 'updated_at',
    ];
    public function Product(){
        return $this->belongsToMany(Product::class, 'product_size', 'product_id','size_id' );
    }
    public function Cart(){
        return $this->hasMany(Cart::class);
    }
}
