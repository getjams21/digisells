<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreaTableCreditCard extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('creditCard', function(Blueprint $table)
		{
			$table -> increments('cardID');
			$table -> string('cardType');
			$table -> string('cardNumber');
			$table -> string('cardName');
			$table -> date('expirationDate');
			$table -> text('billingAddress');
			$table -> string('email');
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
		Schema::drop('creditCard');
	}

}
