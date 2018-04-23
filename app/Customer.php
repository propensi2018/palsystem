<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    //user customer bisa digolongkan kedalam prospect list
  public function prospect()
  {
      return $this->hasOne(Prospect::class);
  }
 public function schedule()
 {
     return $this->hasMany(Schdule::class);
 }
 
}
