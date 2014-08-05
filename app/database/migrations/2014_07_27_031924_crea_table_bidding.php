<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreaTableBidding extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bidding', function(Blueprint $table)
		{
			$table -> increments('id');
			$table -> integer('auctionID')->unsigned();
			$table -> integer('userID')->unsigned();
			$table -> decimal('amount', 19, 4);
			$table -> decimal('maxBid', 19, 4);
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
		Schema::drop('bidding');
	}

}
