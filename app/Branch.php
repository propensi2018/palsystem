<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{

  protected $primaryKey = 'level_id';
  
  public function salesperson()
  {
  return  $this->hasMany(Salesperson::class);
  }
}
