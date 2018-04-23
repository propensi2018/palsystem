<?php

use Illuminate\Database\Seeder;
use App\Manager;

class ManagersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      Manager::create( [
      'user_id'=>1,
      'id_mgr'=>1,
      'is_gh'=>1
      ] );


      Manager::create( [
      'user_id'=>2,
      'id_mgr'=>2,
      'is_gh'=>0
      ] );


      Manager::create( [
      'user_id'=>3,
      'id_mgr'=>3,
      'is_gh'=>0
      ] );


      Manager::create( [
      'user_id'=>4,
      'id_mgr'=>4,
      'is_gh'=>0
      ] );


      Manager::create( [
      'user_id'=>5,
      'id_mgr'=>5,
      'is_gh'=>0
      ] );

    }
}
