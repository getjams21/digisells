<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyToCreditsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('credits', function(Blueprint $table)
		{
			$table-> foreign('userID')->references('userID')->on('user')
			->onDelete('restrict')->onUpdate('cascade');
			$table-> foreign('salesID')->references('salesID')->on('sales')
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
		Schema::table('credits', function(Blueprint $table)
		{
			$table->dropForeign('credits_userID_foreign');
			$table->dropForeign('credits_salesID_foreign');
		});
	}

}
