<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyToProductTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('product', function(Blueprint $table)
		{
			$table-> foreign('userID')->references('userID')->on('user')
			->onDelete('restrict')->onUpdate('cascade');
			$table-> foreign('categoryID')->references('categoryID')->on('category')
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
		Schema::table('product', function(Blueprint $table)
		{
			$table->dropForeign('product_userID_foreign');
			$table->dropForeign('product_categoryID_foreign');
		});
	}

}
