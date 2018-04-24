<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    //
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

}
