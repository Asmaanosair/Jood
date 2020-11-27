<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $hidden = [
        'updated_at','payment_method_id','user_id'
    ];
    public function Product(){
        return $this->belongsToMany(Product::class, 'order_product', 'order_id', 'product_id')->withPivot('amount','color','size');
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function PaymentMethod(){
        return $this->belongsTo(PaymentMethod::class);
    }
    public function Delivery(){
        return $this->belongsToMany(User::class, 'delivery_orders', 'order_id','user_id' );
    }
}
