<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreaTableAuction extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('auction', function(Blueprint $table)
		{
			$table -> increments('auctionID');
			$table -> string('auctionName',50);
			$table -> integer('productID')->unsigned();
			$table -> decimal('minimumPrice', 19, 4);
			$table -> decimal('buyoutPrice', 19, 4);
			$table -> dateTime('startDate');
			$table -> dateTime('endDate');
			$table -> string('incrementation');
			$table -> float('affiliatePercentage');
			$table -> boolean('sold')->default(0);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('auction');
	}

}
