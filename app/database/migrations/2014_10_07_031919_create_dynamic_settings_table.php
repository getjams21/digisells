<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDynamicSettingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('settings', function(Blueprint $table)
		{
			$table -> increments('id');
			$table ->decimal('buyer', 19, 4)->default(0.01000);
			$table ->decimal('company', 19, 4)->default(0.0900);
			$table ->decimal('reward', 19, 4)->default(0.0300);
			$table ->decimal('sellingfee', 19, 4)->default(0.0200);
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
		Schema::drop('settings');
	}

}
