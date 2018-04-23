<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    //
  public function salesperson()
  {
  return  $this->hasMany(Salesperson::class);
  }
}
