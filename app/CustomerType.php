<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerType extends Model
{
    //
  public function prospect()
  {
  return $this->belongsTo(Prospect::class);
  }
  
}
