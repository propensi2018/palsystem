<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    public function scheduleType()
  {
     return $this->hasOne(ScheduleType::class);
  }
    
    public function activityType()
    {
    return $this->belongsTo(ActivityType::class);
    }
}
