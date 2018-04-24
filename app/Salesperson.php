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
}
