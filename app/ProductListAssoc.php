<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductListAssoc extends Model
{
    protected $primaryKey = 'assoc_id';

    public function productList()
    {
        return $this->belongsTo(ProductList::class);
    }
    public function productType()
    {
        return $this->hasMany(ProductType::class);
    }
    public function type()
    {
        return $this->belongsTo(ProductType::class);
    }
}
