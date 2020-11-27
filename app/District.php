<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    public function Branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
