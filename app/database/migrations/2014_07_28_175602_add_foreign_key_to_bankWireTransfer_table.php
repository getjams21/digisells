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
			$table-> foreign('intermidiaryID')->references('intermidiaryID')->on('bankIntermidiary')
			->onDelete('restrict')->onUpdate('cascade');
			$table-> foreign('fundID')->references('fundID')->on('funds')
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
			$table->dropForeign('bankWireTransfer_fundID_foreign');
		});
	}

}
