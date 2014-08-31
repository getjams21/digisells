<?php

class RoleTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();
		Role::create([
			'name' => 'member'
		]);
		Role::create([
			'name' => 'admin'
		]);
		Role::create([
			'name' => 'owner'
		]);
		
		// $this->call('UserTableSeeder');
	}

}
