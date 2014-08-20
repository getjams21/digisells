<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyToReviewsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('reviews', function(Blueprint $table)
		{
			$table-> foreign('userID')->references('id')->on('user')
			->onDelete('restrict')->onUpdate('cascade');
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
		Schema::table('reviews', function(Blueprint $table)
		{
			$table->dropForeign('reviews_userID_foreign');
			$table->dropForeign('reviews_productID_foreign');
		});
	}

}
