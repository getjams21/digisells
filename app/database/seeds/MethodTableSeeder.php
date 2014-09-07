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
<<<<<<< HEAD
			'methodName' => 'bidding',
			'methodDesc' => 'Deduct fund from bidding'
			]);
=======
			'methodName' => 'paypal withdrawal',
			'methodDesc' => 'withdrawal of Funds via Paypal'
			]);
	
	
>>>>>>> c0e132a6f0e481e21ef6cfcb15dbeb108567d7f3
		// $this->call('UserTableSeeder');
	}

}
