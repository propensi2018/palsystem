<?php

use Illuminate\Database\Seeder;

class TelephonesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 25; $i++) {
          DB::table('telephones')->insert([
             'telp_no' => str_random(10),
             'descr' => str_random(15),
             'customer_id' => $i,
         ]);
        }
    }
}
