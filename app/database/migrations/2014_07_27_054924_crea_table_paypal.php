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
			$table -> integer('userID')->unsigned();
			$table -> integer('methodID')->unsigned();
			$table -> string('paymentID');
			$table -> decimal('amount', 19, 2);
			$table -> boolean('status')->default(0);
			$table -> timestamps();
			$table-> foreign('userID')->references('id')->on('user')
			->onDelete('restrict')->onUpdate('cascade');
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
