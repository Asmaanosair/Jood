<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $hidden = ["created_at", "updated_at"];
    public function SubCategory()
    {
        return $this->hasMany(SubCategory::class);
    }

    public function getImageAttribute($value)
    {
        return url($value);
    }
}
