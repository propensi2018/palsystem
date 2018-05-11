<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
  protected $primaryKey = 'sales_user_id';

  public function Salesperson()
  {
    $this->belongsToMany(Salesperson::class);
  }
  public function User()
  {
    $this->belongsToMany(User::class);
  }
}
