<?php

class MethodTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();
		Method::create([
			'methodName' => 'credit card deposit',
			'methodDesc' => 'Added Funds via credit card'
			]);
		Method::create([
			'methodName' => 'paypal deposit',
			'methodDesc' => 'Added Funds via Paypal'
			]);
		Method::create([
			'methodName' => 'bidding',
			'methodDesc' => 'Deduct fund from bidding'
			]);
		// $this->call('UserTableSeeder');
	}

}
