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
			$table -> string('username',30)->unique();
			$table -> string('email',50)->unique();
			$table -> string('password',100);
			$table -> string('type',50)->nullable();
			$table -> string('userImage',50)->nullable();
			$table -> string('remember_token')->nullable();
			$table ->decimal('fund', 19, 2)->default(0.00);
			$table -> boolean('status')->default(1);
			$table->timestamp('last_activity')->nullable();
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
