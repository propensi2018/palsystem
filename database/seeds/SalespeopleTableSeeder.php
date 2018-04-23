<?php

use Illuminate\Database\Seeder;
use App\Salesperson;

class SalespeopleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Salesperson::create( [
        'user_id'=>6,
        'id_sp'=>1,
        'branch_level_id'=>4
        ] );


        Salesperson::create( [
        'user_id'=>7,
        'id_sp'=>2,
        'branch_level_id'=>4
        ] );


        Salesperson::create( [
        'user_id'=>8,
        'id_sp'=>3,
        'branch_level_id'=>4
        ] );


        Salesperson::create( [
        'user_id'=>9,
        'id_sp'=>4,
        'branch_level_id'=>4
        ] );


        Salesperson::create( [
        'user_id'=>10,
        'id_sp'=>5,
        'branch_level_id'=>4
        ] );


        Salesperson::create( [
        'user_id'=>11,
        'id_sp'=>6,
        'branch_level_id'=>4
        ] );


        Salesperson::create( [
        'user_id'=>12,
        'id_sp'=>7,
        'branch_level_id'=>4
        ] );


        Salesperson::create( [
        'user_id'=>13,
        'id_sp'=>8,
        'branch_level_id'=>5
        ] );


        Salesperson::create( [
        'user_id'=>14,
        'id_sp'=>9,
        'branch_level_id'=>5
        ] );


        Salesperson::create( [
        'user_id'=>15,
        'id_sp'=>10,
        'branch_level_id'=>5
        ] );


        Salesperson::create( [
        'user_id'=>16,
        'id_sp'=>11,
        'branch_level_id'=>5
        ] );


        Salesperson::create( [
        'user_id'=>17,
        'id_sp'=>12,
        'branch_level_id'=>5
        ] );


        Salesperson::create( [
        'user_id'=>18,
        'id_sp'=>13,
        'branch_level_id'=>5
        ] );


        Salesperson::create( [
        'user_id'=>19,
        'id_sp'=>14,
        'branch_level_id'=>5
        ] );


        Salesperson::create( [
        'user_id'=>20,
        'id_sp'=>15,
        'branch_level_id'=>5
        ] );

    }
}
