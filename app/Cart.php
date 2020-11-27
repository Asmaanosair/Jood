<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $hidden = [
        'created_at', 'updated_at','size_id','color_id'
    ];


    public function User()
    {
        return $this->belongsTo(User::class);
    }
    public function Size(){
        return $this->belongsTo(Size::class );
    }
    public function Color(){
        return $this->belongsTo(Color::class);
    }
    public function Product(){
        return $this->belongsTo(Product::class);
    }
}
