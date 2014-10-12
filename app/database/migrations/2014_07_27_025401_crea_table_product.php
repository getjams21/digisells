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
			$table -> increments('id');
			$table -> integer('subcategoryID')->unsigned();
			$table -> integer('userID')->unsigned();
			$table -> string('productName');
			$table -> text('productDescription');
			$table -> integer('quantity');
			$table -> string('imageURL');
			$table -> string('downloadLink');
			$table -> text('details');
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
