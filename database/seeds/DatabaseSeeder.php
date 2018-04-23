<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$this->call(
    		[
          AddressesTableSeeder::class,
          UsersTableSeeder::class,
          CustomersTableSeeder::class,
          ActivityTypesTableSeeder::class,
          ProspectWillingnessesTableSeeder::class,
          CustomerTypesTable::class,
          LevelsTableSeeder::class,
          RegionsTableSeeder::class,
          BranchesTableSeeder::class,
          SalespeopleTableSeeder::class,
          MessagesTableSeeder::class,
          MessageReceivedsTableSeeder::class,
          ProductClassesTableSeeder::class,
          ProductTypesTableSeeder::class,
          ManagerTableSeeder::class,
          AddressesTableSeeder::class,
    		]
    	);
    }
}
