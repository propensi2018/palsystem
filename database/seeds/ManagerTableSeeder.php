<?php

use Illuminate\Database\Seeder;

class ManagerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$array = [
    		[1, true],
    		[2, false],
    		[3, true],
    		[4, false],
    		[5, false]
    	];

        foreach ($array as $iden) {
		    DB::table('managers')->insert([
		            'user_id' => $iden[0],
		            'id_mgr' => $iden[0] + 30,
		            'is_gh' => $iden[1],
	        ]);
        }
    }
}
