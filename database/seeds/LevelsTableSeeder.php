<?php

use Illuminate\Database\Seeder;
use App\Level;

class LevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Level::create( [
      'id'=>1,
      'name'=>'Nagarakembang'
      ] );


      Level::create( [
      'id'=>2,
      'name'=>'Moss'
      ] );


      Level::create( [
      'id'=>3,
      'name'=>'Adelaide'
      ] );


      Level::create( [
      'id'=>4,
      'name'=>'Alderetes'
      ] );


      Level::create( [
      'id'=>5,
      'name'=>'Jiguan'
      ] );
      
    }
}
