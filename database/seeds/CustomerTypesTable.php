<?php

use Illuminate\Database\Seeder;
use App\CustomerType;

class CustomerTypesTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      CustomerType::create( [
      'id'=>1,
      'name'=>'Warm',
      'desc' => ''
      ] );
      CustomerType::create( [
      'id'=>2,
      'name'=>'Hot',
      'desc' => ''
      ] );

    }
}
