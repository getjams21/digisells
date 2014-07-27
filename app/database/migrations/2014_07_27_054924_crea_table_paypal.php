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
			$table -> increments('paypalID');
			$table -> integer('userID');
			$table -> string('paypalEmail');
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
		Schema::table('paypal', function(Blueprint $table)
		{
			//
		});
	}

}
