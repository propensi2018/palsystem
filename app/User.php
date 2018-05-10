<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public function role_complex () {
      $tester = DB::table('salespeople')
      ->where('salespeople.user_id',$this->id)
      ->get();
      $tester2 = DB::table('managers')
      ->where('managers.user_id', $this->id)
      ->get();
      return $tester2;
      if ($tester->isEmpty()) {
        // return 'abap';
        return $tester;
      } else {
        // return 'apap';
        return $tester2;
      }
    }

    /*
    return the type of role the user is
    */
    public function role () {
      $tester = DB::table('salespeople')
      ->where('salespeople.user_id',$this->id)
      ->get();
      $tester2 = DB::table('managers')
      ->where('managers.user_id', $this->id)
      ->get();
      return $tester2;
      if ($tester->isEmpty()) {
        // return 'abap';
        return 'salesperson';
      } else {
        if ($tester2 -> is_gh == 1) {
          return 'group_head';
        }
        $tester3 = DB::table('regions')
        ->where('regions.mgr_user_id', $this->id)
        ->get();
        if (!$tester->isEmpty()) {
          return 'regional_manager'
        }
        return 'branch_manager';
      }
    }
}
