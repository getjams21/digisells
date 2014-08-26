<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatTableWatchlist extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('watchlist', function(Blueprint $table)
		{
			$table -> increments('id');
			$table -> integer('productID')->unsigned()->nullable();
			$table -> integer('userID')->unsigned();
			$table -> integer('watcherID')->unsigned();
			$table -> boolean('status')->default(0);
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
		Schema::drop('watchlist');
	}

}
