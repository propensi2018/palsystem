<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProspectWillingness extends Model
{
    //
     public function prospect()
    {
        return $this->belongsTo(Prospect::class);
    }
}
