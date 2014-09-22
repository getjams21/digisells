<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreaTableAffiliates extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('affiliates', function(Blueprint $table)
		{
			$table -> increments('id');
			$table -> integer('userID')->unsigned();
			$table -> integer('auctionID')->unsigned()->nullable();
			$table -> integer('sellingID')->unsigned()->nullable();
			$table -> string('referralLink');
			$table -> timestamps();
			$table-> foreign('userID')->references('id')->on('user')
			->onDelete('restrict')->onUpdate('cascade');
			$table-> foreign('auctionID')->references('id')->on('auction')
			->onDelete('restrict')->onUpdate('cascade');
			$table-> foreign('sellingID')->references('id')->on('selling')
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
		Schema::drop('affiliates');
	}

}
