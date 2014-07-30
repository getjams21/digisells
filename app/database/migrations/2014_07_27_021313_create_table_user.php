<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUser extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user', function(Blueprint $table)
		{
			$table -> increments('id');
			$table -> string('firstName',50);
			$table -> string('lastName',50);
			$table -> text('address');
			$table -> string('email',50)->unique();
			$table -> string('password');
			$table -> string('paymentMethod',50);
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
		Schema::drop('user');
	}

}
