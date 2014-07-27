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
			$table -> increments('fundID');
			$table -> integer('userID');
			$table -> decimal('amountAdded', 19, 4);
			$table -> decimal('amountDeducted', 19, 4);
			$table -> string('method', 50);
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
		Schema::table('funds', function(Blueprint $table)
		{
			//
		});
	}

}
