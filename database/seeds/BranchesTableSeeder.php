<?php

use Illuminate\Database\Seeder;
use App\Branch;

class BranchesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Branch::create( [
      'level_id'=>4,
      'branch_id'=>1,
      'mgr_user_id'=>4,
      'region_level_id'=>2,
      'address_id'=>4
      ] );


      Branch::create( [
      'level_id'=>5,
      'branch_id'=>2,
      'mgr_user_id'=>5,
      'region_level_id'=>3,
      'address_id'=>5
      ] );

    }
}
