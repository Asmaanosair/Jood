<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    public function District()
    {
        return $this->hasMany(District::class);
    }
    public function Product(){
        return $this->belongsToMany(Product::class, 'product_branch', 'branch_id', 'product_id')->withPivot('amount');
    }

}
