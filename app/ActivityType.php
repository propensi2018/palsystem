<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivityType extends Model
{
    //
    public function appointment()
    {
         $this->hasOne(Appointment::class);
    }
   
}
