<?php

use Illuminate\Database\Seeder;
use App\ProductClass;

class ProductClassesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      ProductClass::create( [
      'id'=>1,
      'name'=>'Aggresive',
      'desc' => 'Aggresive'
      ] );
      ProductClass::create( [
      'id'=>2,
      'name'=>'Moderate',
      'desc' => 'Moderate'
      ] );
      ProductClass::create( [
      'id'=>3,
      'name'=>'Conservative',
      'desc' => 'Conservative'
      ] );

    }
}
