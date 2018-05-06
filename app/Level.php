<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
  public function statisticType() {
    return $this->hasOne(StatisticType::class, 'id_level');
  }

}
