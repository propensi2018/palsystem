<?php

use Illuminate\Database\Seeder;
use App\ProspectWillingness;

class ProspectWillingnessesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      ProspectWillingness::create( [
      'id'=>1,
      'name'=>'Aggresive',
      'desc' => 'Aggresive'
      ] );
      ProspectWillingness::create( [
      'id'=>2,
      'name'=>'Moderate',
      'desc' => 'Moderate'
      ] );
      ProspectWillingness::create( [
      'id'=>3,
      'name'=>'Conservative',
      'desc' => 'Conservative'
      ] );
    }
}
