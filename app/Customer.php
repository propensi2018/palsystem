<?php

namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{

    // protected $primaryKey = 'user_id';
    //user customer bisa digolongkan kedalam prospect list

    //retrieve last currently appointed schedule to customer
    public function retrieve_last_schedule($id_user_sp) {
      return DB::table('schedules')
          ->join('schedule_types', 'schedule_types.id', '=', 'schedules.schedule_type_id')
          // ->where('id_user_sp', $this -> id_user_sp)
          ->where('id_user_sp', $id_user_sp)
          ->where('id_customer', $this->id)
          ->where('is_done',0)
          ->where('telp_flag',1)
          ->select('schedules.id as schedule_id','id_customer', 'schedules.*')
          ->get()->first();
    }

    // retreive all product history of a customer
    public function retrieve_list_of_product() {
      $all_product = DB::table('schedules')
      -> join ('product_lists', 'schedules.id', '=', 'product_lists.schedule_id')
      -> join ('product_list_assocs', 'product_list_assocs.product_list_id', '=', 'product_lists.id')
      -> join ('product_types', 'product_list_assocs.id_ptype', '=', 'product_types.id')
      -> join ('schedule_types', 'schedule_types.id', '=', 'schedules.schedule_type_id')
      -> join ('appointments', 'appointments.id', '=', 'schedule_types.appointment_id')
      -> join ('activity_types', 'activity_types.id', '=', 'appointments.id_act_type')
      -> where ('schedules.id_customer', $this->id)
      -> select('product_types.desc', 'product_list_assocs.amount', 'schedules.id as schedule_id', 'activity_types.name')
      ->get();
      return $all_product;
    }

    public function one() {
      return '1';
    }

    public function prospect()
    {
        return $this->hasOne(Prospect::class);
    }
   public function schedule()
   {
       return $this->hasMany(Schdule::class);
   }
}
