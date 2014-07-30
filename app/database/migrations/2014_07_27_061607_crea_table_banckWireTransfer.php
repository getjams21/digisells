<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreaTableBanckWireTransfer extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bankWireTransfer', function(Blueprint $table)
		{
			$table -> increments('id');
			$table -> string('bankName');
			$table -> string('accountName');
			$table -> string('benificiaryAddress');
			$table -> string('internationalAccountNumber');
			$table -> text('bankAddress');
			$table -> string('branchIndentifier');
			$table -> integer('intermidiaryID')->unsigned();
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
		Schema::drop('bankWireTransfer');
	}

}
