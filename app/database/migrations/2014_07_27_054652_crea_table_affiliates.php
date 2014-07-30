<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreaTableAffiliates extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('affiliates', function(Blueprint $table)
		{
			$table -> increments('id');
			$table -> integer('userID')->unsigned();
			$table -> integer('productID')->unsigned();
			$table -> string('referralLink');
			$table -> integer('salesID')->unsigned();
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
		Schema::drop('affiliates');
	}

}
