<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyToWatchlistTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('watchlist', function(Blueprint $table)
		{
			$table-> foreign('productID')->references('id')->on('product')
			->onDelete('restrict')->onUpdate('cascade');
			$table-> foreign('userID')->references('id')->on('user')
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
		Schema::table('watchlist', function(Blueprint $table)
		{
			$table->dropForeign('watchlist_productID_foreign');
			$table->dropForeign('watchlist_userID_foreign');
		});
	}

}
