<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyToFundsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('funds', function(Blueprint $table)
		{
			$table-> foreign('userID')->references('userID')->on('user')
			->onDelete('restrict')->onUpdate('cascade');
			$table-> foreign('salesID')->references('salesID')->on('sales')
			->onDelete('restrict')->onUpdate('cascade');
			$table-> foreign('methodID')->references('methodID')->on('method')
			->onDelete('restrict')->onUpdate('cascade');
			$table-> foreign('biddingID')->references('biddingID')->on('bidding')
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
		Schema::table('funds', function(Blueprint $table)
		{
			$table->dropForeign('funds_userID_foreign');
			$table->dropForeign('funds_salesID_foreign');
			$table->dropForeign('funds_methodID_foreign');
			$table->dropForeign('funds_biddingID_foreign');
		});
	}

}
