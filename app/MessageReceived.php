<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MessageReceived extends Model
{
    protected $primaryKey = 'id_receive_association';

    public function user()
    {
        $this->belongsToMany(User::class);
    }
    public function message(){
        $this->hasMany(Message::class);
    }
}
