<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreaTableProduct extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('product', function(Blueprint $table)
		{
			$table -> increments('productID');
			$table -> integer('categoryID')->unsigned();
			$table -> integer('userID')->unsigned();
			$table -> string('productName');
			$table -> text('productDescription');
			$table -> integer('quantity');
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
		Schema::drop('product');
	}

}
