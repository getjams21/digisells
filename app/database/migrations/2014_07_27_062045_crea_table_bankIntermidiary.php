<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreaTableBankIntermidiary extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bankIntermidiary', function(Blueprint $table)
		{
			$table -> increments('intermidiaryID');
			$table -> string('bankAddress');
			$table -> string('bankName');
			$table -> string('chipsIdNumber');
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
		Schema::table('bankIntermidiary', function(Blueprint $table)
		{
			//
		});
	}

}
