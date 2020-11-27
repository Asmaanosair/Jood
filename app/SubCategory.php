<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Project;

class SubCategory extends Model
{
    protected $hidden = ["created_at", "updated_at",'visibility'];

    public function Category()
    {
        return $this->hasMany(Category::class);
    }
    public function getImageAttribute($value)
    {
        return url($value);
    }
    public function Product()
    {
        return $this->hasMany(Product::class);
    }
    public function Products()
    {
        return $this->hasMany(Product::class)->take(10);
    }

}
