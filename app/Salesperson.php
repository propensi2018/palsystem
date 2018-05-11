<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salesperson extends Model
{
    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function branch()
    {
      return $this->belongsTo(Branch::class);
    }

    public function statisticType() {
      return $this->hasOne(StatisticType::class, 'id_user_sp');
    }
    public function Rating() {
      return $this->hasOne(Rating::class, 'sales_user_id');
    }

}
