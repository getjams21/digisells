<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyToAffiliatesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('affiliates', function(Blueprint $table)
		{
			$table-> foreign('userID')->references('id')->on('user')
			->onDelete('restrict')->onUpdate('cascade');
			$table-> foreign('productID')->references('id')->on('product')
			->onDelete('restrict')->onUpdate('cascade');
			$table-> foreign('salesID')->references('id')->on('sales')
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
		Schema::table('affiliates', function(Blueprint $table)
		{
			$table->dropForeign('affiliates_userID_foreign');
			$table->dropForeign('affiliates_productID_foreign');
			$table->dropForeign('affiliates_salesID_foreign');
		});
	}

}
