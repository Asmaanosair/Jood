<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $hidden = [
     'created_at','updated_at','active'
    ];
    public function order(){
        return $this->hasMany(Order::class);
    }
}
