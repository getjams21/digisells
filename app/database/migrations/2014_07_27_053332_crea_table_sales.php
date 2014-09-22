<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreaTableSales extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sales', function(Blueprint $table)
		{
			$table -> increments('id');
			$table -> integer('auctionID')->unsigned()->nullable();
			$table -> integer('sellingID')->unsigned()->nullable();
			$table -> integer('affiliateID')->unsigned()->nullable();
			$table -> integer('buyerID')->unsigned();
			$table -> decimal('amount', 19, 4);
			$table -> integer('transactionNO');
			$table -> timestamps();
			$table-> foreign('buyerID')->references('id')->on('user')
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
		Schema::drop('sales');
	}

}
