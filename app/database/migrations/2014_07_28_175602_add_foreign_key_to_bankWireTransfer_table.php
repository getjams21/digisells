<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyToBankWireTransferTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('bankWireTransfer', function(Blueprint $table)
		{
			$table-> foreign('intermidiaryID')->references('id')->on('bankIntermidiary')
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
		Schema::table('bankWireTransfer', function(Blueprint $table)
		{
			$table->dropForeign('bankWireTransfer_intermidiaryID_foreign');
		});
	}

}
