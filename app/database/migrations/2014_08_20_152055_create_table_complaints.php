<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableComplaints extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('complaints', function(Blueprint $table)
		{
			$table->increments('id');
			$table -> integer('userID')->unsigned();
			$table -> integer('productID')->unsigned()->nullable();
			$table -> integer('ticket');
			$table -> string('title');
			$table -> string('category');
			$table -> string('priority');
			$table -> string('screenshot')->nullable();
			$table -> boolean('solved')->default(0);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('complaints');
	}

}
