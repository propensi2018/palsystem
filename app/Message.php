<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
    public function messageReceived()
    {
        $this->belongsToMany(Message::class);
    }
    public function User()
    {
      $this->belongsToMany(User::class);
    }
}
