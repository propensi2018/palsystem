<?php

use Illuminate\Database\Seeder;

class AddressesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($x = 0; $x < 5; $x++) {
	        DB::table('addresses')->insert([
	            'postal_code' => str_random(5),
	            'province' => str_random(15),
	            'street' => str_random(15),
	            'city' => str_random(15),
	            'kelurahan' => str_random(15),
	            'district' => str_random(15),
        	]);
    	}
    }
}
