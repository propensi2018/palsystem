<?php

use Illuminate\Database\Seeder;
use App\ProductType;

class ProductTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      ProductType::create( [
      'id'=>1,
      'desc'=>'Reksadana I',
      'is_deleted'=>0,
      'id_class'=>1
      ] );


      ProductType::create( [
      'id'=>2,
      'desc'=>'Reksadana II',
      'is_deleted'=>0,
      'id_class'=>2
      ] );


      ProductType::create( [
      'id'=>3,
      'desc'=>'Brokerage I',
      'is_deleted'=>0,
      'id_class'=>3
      ] );


      ProductType::create( [
      'id'=>4,
      'desc'=>'Brokerage II',
      'is_deleted'=>0,
      'id_class'=>1
      ] );


      ProductType::create( [
      'id'=>5,
      'desc'=>'Debt Capital I',
      'is_deleted'=>0,
      'id_class'=>2
      ] );


      ProductType::create( [
      'id'=>6,
      'desc'=>'Debt Capital II',
      'is_deleted'=>0,
      'id_class'=>3
      ] );

    }
}
