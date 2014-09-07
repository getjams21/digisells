<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyToPaypalTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('paypal', function(Blueprint $table)
		{
			$table-> foreign('methodID')->references('id')->on('method')
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
		Schema::table('paypal', function(Blueprint $table)
		{
			$table->dropForeign('paypal_methodID_foreign');
		});
	}

}
