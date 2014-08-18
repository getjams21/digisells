<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreaTablePaypal extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('paypal', function(Blueprint $table)
		{
			$table -> increments('id');
			$table -> string('paypalEmail')->nullable();
			$table -> string('paymentID');
			$table -> decimal('amount', 19, 2);
			$table -> integer('fundID')->nullable()->unsigned();
			$table -> timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('paypal');
	}

}
