<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreaTableSelling extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('selling', function(Blueprint $table)
		{
			$table -> increments('id');
			$table -> string('sellingName');
			$table -> integer('productID')->unsigned();
			$table -> decimal('price', 19, 4);
			$table -> float('discount');
			$table -> dateTime('listingDate');
			$table -> dateTime('expirationDate');
			$table -> float('affiliatePercentage');
			$table -> boolean('sold')->default(0);
			$table -> boolean('paid')->default(0);
			$table -> string('payKey')->nullable();
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
		Schema::drop('selling');
	}

}
