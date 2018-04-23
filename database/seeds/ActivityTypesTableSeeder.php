<?php

use Illuminate\Database\Seeder;
use App\ActivityType;

class ActivityTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      ActivityType::create( [
      'id'=>1,
      'name'=>'Presentation',
      'desc' => ''
      ] );
      ActivityType::create( [
      'id'=>2,
      'name'=>'Fix',
      'desc' => ''
      ] );
      ActivityType::create( [
      'id'=>3,
      'name'=>'Commit',
      'desc' => ''
      ] );
      ActivityType::create( [
      'id'=>4,
      'name'=>'Deal',
      'desc' => ''

      ] );

    }
}
