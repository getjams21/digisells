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
			$table -> decimal('amountAdded', 19, 2)->default(0);
			$table -> decimal('amountDeducted', 19, 2)->default(0);
			$table -> integer('methodID')->unsigned();
			$table -> integer('salesID')->nullable()->unsigned();
			$table -> integer('biddingID')->nullable()->unsigned();
			$table -> boolean('status')->default(0);
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
