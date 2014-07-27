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
			$table -> increments('biddingID');
			$table -> integer('auctionID');
			$table -> integer('userID');
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
		Schema::table('bidding', function(Blueprint $table)
		{
			//
		});
	}

}
