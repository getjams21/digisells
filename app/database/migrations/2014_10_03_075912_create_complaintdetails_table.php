<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComplaintdetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('complaintdetails', function(Blueprint $table)
		{
			$table->increments('id');
			$table -> integer('complaintID')->unsigned();
			$table -> integer('senderID')->unsigned();
			$table -> text('description');
			$table->timestamps();
			$table-> foreign('complaintID')->references('id')->on('complaints')
			->onDelete('restrict')->onUpdate('cascade');
			$table-> foreign('senderID')->references('id')->on('user')
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
		Schema::drop('complaintdetails');
	}

}
