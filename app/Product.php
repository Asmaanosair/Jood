<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
class Product extends Model
{


    protected $hidden = ["created_at", "updated_at"];

    public function getImageAttribute($value)
    {
        return url($value);
    }
    public function getVideoAttribute($value)
    {
        return url($value);
    }
    public function Size(){
        return $this->belongsToMany(Size::class, 'product_size', 'product_id','size_id' );
    }
    public function Color(){
        return $this->belongsToMany(Color::class, 'product_color', 'product_id', 'color_id');
    }
    public function Branch(){
        return $this->belongsToMany(Branch::class, 'product_branch', 'branch_id', 'product_id')->withPivot('amount');
    }
    public function SubCategory(){
        return $this->belongsTo(SubCategory::class);
    }
    public function ProductWithBranch(){
        return $this->belongsToMany(Product::class, 'product_branch', 'branch_id', 'product_id')->with('SubCategory');
    }
    public function ProductImages(){
        return $this->hasMany(ProductImage::class);
    }
    public function ProductDetail(){
        return $this->hasMany(ProductImage::class)->with('Color')->with('Size')->with('Branch')->with('SubCategory');
    }
    public function Cart(){
        return $this->hasMany(Cart::class);
    }
    public function Order(){
        return $this->belongsToMany(Order::class, 'order_product', 'order_id', 'product_id');
    }
}
