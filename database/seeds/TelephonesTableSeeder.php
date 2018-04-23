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
             'no_telp' => str_random(10),
             'desc' => str_random(15),
             'id_customer' => $i,
         ]);
        }
    }
}
