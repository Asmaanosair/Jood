<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $fillable = [
        'product_id', 'image',
    ];
    public function getImageAttribute($value)
    {
        return url($value);
    }
    public function Product(){
        return $this->belongsTo(Product::class);
    }
}
