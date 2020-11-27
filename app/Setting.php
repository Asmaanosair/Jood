<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    public function getImageAttribute($value)
    {
        return url($value);
    }
}
