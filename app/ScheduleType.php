<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScheduleType extends Model
{
    //
    public function schedule()
    {
        return $this->hasMany(Schedule::class);
    }

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
}
