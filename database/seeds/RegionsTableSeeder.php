<?php

use Illuminate\Database\Seeder;
use App\Region;

class RegionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Region::create( [
      'level_id'=>2,
      'region_id'=>1,
      'mgr_user_id'=>2,
      'address_id'=>2
      ] );


      Region::create( [
      'level_id'=>3,
      'region_id'=>2,
      'mgr_user_id'=>3,
      'address_id'=>3
      ] );
    }
}
