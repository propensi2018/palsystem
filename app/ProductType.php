<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    //
    public function productListAssoc()
    {
        return $this->belongsToMany(ProductListAssoc::class);
    }
    public function assoc()
    {
        return $this->hasMany(ProductListAssoc::class);
    }
}
