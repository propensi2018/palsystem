<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductList extends Model
{
    //
    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
    public function productListAssoc(){
        return $this->hasMany(ProductListAssoc::class);
    }
}
