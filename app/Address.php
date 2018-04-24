<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    //
     public function prospect()
    {
        return $this->belongsTo(Prospect::class);
    }
    public function prospectAddress()
    {
        return $this->hasOne(Prospect::class);
    }
}
