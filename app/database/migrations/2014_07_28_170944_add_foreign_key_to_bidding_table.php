<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyToBiddingTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('bidding', function(Blueprint $table)
		{
			$table-> foreign('auctionID')->references('id')->on('auction')
			->onDelete('restrict')->onUpdate('cascade');
			$table-> foreign('userID')->references('id')->on('user')
			->onDelete('restrict')->onUpdate('cascade');
			$table-> foreign('referredBy')->references('id')->on('user')
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
		Schema::table('bidding', function(Blueprint $table)
		{
			$table->dropForeign('bidding_auctionID_foreign');
			$table->dropForeign('bidding_userID_foreign');
			$table->dropForeign('bidding_referredBy_foreign');
		});
	}

}
