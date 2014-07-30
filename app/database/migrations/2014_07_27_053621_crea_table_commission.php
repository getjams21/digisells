<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreaTableCommission extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('commission', function(Blueprint $table)
		{
			$table -> increments('id');
			$table -> integer('userID');
			$table -> integer('salesID');
			$table -> decimal('amount', 19, 4);
			$table -> string('type', 50);
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
		Schema::table('commission', function(Blueprint $table)
		{
			//
		});
	}

}
