<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreaTableFunds extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('funds', function(Blueprint $table)
		{
			$table -> increments('id');
			$table -> integer('userID')->unsigned();
			$table -> decimal('amountAdded', 19, 4);
			$table -> decimal('amountDeducted', 19, 4);
			$table -> integer('methodID')->unsigned();
			$table -> integer('salesID')->default(0)->unsigned();
			$table -> integer('biddingID')->default(0)->unsigned();
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
		Schema::drop('funds');
	}

}
