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
			$table -> string('paypalEmail');
			$table -> integer('fundID')->unsigned();
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
