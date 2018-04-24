<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function messageReceiver()
    {
        $this->hasMany(MessageReceived::class);
    }
    public function message()
    {
      return  $this->hasMany(Message::class);
    }
    public function salesperson()
    {
      return $this->hasMany(Salesperson::class);
    }
}
