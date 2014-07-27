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
			$table -> increments('wireTransferID');
			$table -> string('bankName');
			$table -> string('accountName');
			$table -> string('benificiaryAddress');
			$table -> string('internationalAccountNumber');
			$table -> text('bankAddress');
			$table -> string('branchIndentifier');
			$table -> integer('intermidiaryID');
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
		Schema::table('bankWireTransfer', function(Blueprint $table)
		{
			//
		});
	}

}
