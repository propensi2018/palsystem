<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    //
    public function last_appointment_type() {
      try {
        return $this->previousSchedule->scheduleType->appointment->id_act_type;
      } catch (\Exception $e) {
        return 0;
      }
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function productList()
    {
        return $this->hasOne(ProductList::class);
    }
    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
    public function scheduleType()
    {
        return $this->belongsTo(ScheduleType::class);
    }
    public function nextSchedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    public function previousSchedule()
    {
        return $this->hasOne(Schedule::class, 'next_schedule_id');
    }

}
