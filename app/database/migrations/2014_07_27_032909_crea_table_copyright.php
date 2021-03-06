<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreaTableCopyright extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('copyright', function(Blueprint $table)
		{
			$table -> increments('id');
			$table -> integer('productID')->unsigned();
			$table -> string('supportingFiles');
			$table -> text('description');
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
		Schema::drop('copyright');
	}

}
