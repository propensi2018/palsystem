<?php

use Illuminate\Database\Seeder;
use App\Customer;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Customer::create( [
      'id'=>1,
      'name'=>'Zebedee O',
      'is_act'=>0,
      'pic_sp_id'=>6,
      ] );


      Customer::create( [
      'id'=>2,
      'name'=>'Mendie Smallwood',
      'is_act'=>0,
      'pic_sp_id'=>7,
      ] );


      Customer::create( [
      'id'=>3,
      'name'=>'Ottilie Grundwater',
      'is_act'=>0,
      'pic_sp_id'=>8,

      ] );

      Customer::create( [
      'id'=>4,
      'name'=>'Cristionna Sweatland',
      'is_act'=>0,
      'pic_sp_id'=>8,
      ] );


      Customer::create( [
      'id'=>5,
      'name'=>'Shawn Crumpton',
      'is_act'=>0,
      'pic_sp_id'=>9,
      ] );


      Customer::create( [
      'id'=>6,
      'name'=>'Rafaello Loweth',
      'is_act'=>0,
      'pic_sp_id'=>10,
      ] );


      Customer::create( [
      'id'=>7,
      'name'=>'Bili Grimshaw',
      'is_act'=>0,
      'pic_sp_id'=>11,
      ] );


      Customer::create( [
      'id'=>8,
      'name'=>'Patsy Aneley',
      'is_act'=>0,
      'pic_sp_id'=>12,

      ] );


      Customer::create( [
      'id'=>9,
      'name'=>'Nikos Stenyng',
      'is_act'=>0,
      'pic_sp_id'=>13,

      ] );


      Customer::create( [
      'id'=>10,
      'name'=>'Davy Merrien',
      'is_act'=>0,
      'pic_sp_id'=>14,
      ] );


      Customer::create( [
      'id'=>11,
      'name'=>'Erwin Mahy',
      'is_act'=>0,
      'pic_sp_id'=>15,

      ] );


      Customer::create( [
      'id'=>12,
      'name'=>'Robbie Fick',
      'is_act'=>0,
      'pic_sp_id'=>16,

      ] );


      Customer::create( [
      'id'=>13,
      'name'=>'Barclay Pitkethly',
      'is_act'=>0,
      'pic_sp_id'=>16,

      ] );


      Customer::create( [
      'id'=>14,
      'name'=>'Wylma Baszniak',
      'is_act'=>0,
      'pic_sp_id'=>6,

      ] );


      Customer::create( [
      'id'=>15,
      'name'=>'Prue Moultrie',
      'is_act'=>0,
      'pic_sp_id'=>7,

      ] );

      Customer::create( [
      'id'=>16,
      'name'=>'Eileen Puttergill',
      'is_act'=>0,
      'pic_sp_id'=>8,
      ] );

      Customer::create( [
      'id'=>17,
      'name'=>'Kassie Sinfield',
      'is_act'=>0,
      'pic_sp_id'=>9,
      ] );

      Customer::create ([

      'id'=>18,
      'name'=>'Farra Morales',
      'is_act'=>0,
      'pic_sp_id'=>10,

      ] );


      Customer::create( [
      'id'=>19,
      'name'=>'Orville Davidoff',
      'is_act'=>0,
      'pic_sp_id'=>11,
      ] );


      Customer::create( [
      'id'=>20,
      'name'=>'Zebedee O',
      'is_act'=>0,
      'pic_sp_id'=>12,

      ] );


      Customer::create( [
      'id'=>21,
      'name'=>'Editha Di Ruggero',
      'is_act'=>0,
      'pic_sp_id'=>13,

      ] );


      Customer::create( [
      'id'=>22,
      'name'=>'Hester Strudwick',
      'is_act'=>0,
      'pic_sp_id'=>14,

      ] );


      Customer::create( [
      'id'=>23,
      'name'=>'Agnesse Glazyer',
      'is_act'=>0,
      'pic_sp_id'=>15,

      ] );


      Customer::create( [
      'id'=>24,
      'name'=>'Nissy McGenis',
      'is_act'=>0,
      'pic_sp_id'=>19,

      ] );


      Customer::create( [
      'id'=>25,
      'name'=>'Amory Reith',
      'is_act'=>0,
      'pic_sp_id'=>20,

      ] );
    }
}
