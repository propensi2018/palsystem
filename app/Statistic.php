<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
  public function statisticType()
  {
      return $this->belongsTo(StatisticType::class);
  }
  // public function productList()
  // {
  //     return $this->hasOne(ProductList::class);
  // }

}
