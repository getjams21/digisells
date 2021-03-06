<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignSubcategoryToProduct extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('product', function(Blueprint $table)
		{
			$table-> foreign('subcategoryID')->references('id')->on('subcategory')
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
			$table->dropForeign('product_subcategoryID_foreign');
		});
	}

}
