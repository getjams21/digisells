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
			$table -> string('firstName',50)->nullable();
			$table -> string('lastName',50)->nullable();
			$table -> text('address')->nullable();
			$table -> string('username',15)->unique();
			$table -> string('email',50)->unique();
			$table -> string('password',60);
			$table -> string('paymentMethod',50)->nullable();
			$table -> string('userImage',50)->nullable();
			$table -> string('remember_token')->nullable();
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
