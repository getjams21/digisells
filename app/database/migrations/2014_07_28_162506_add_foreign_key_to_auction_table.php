<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyToAuctionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('auction', function(Blueprint $table)
		{
			$table-> foreign('productID')->references('id')->on('product')
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
		Schema::table('auction', function(Blueprint $table)
		{
			$table->dropForeign('auction_productID_foreign');
		});
	}

}
