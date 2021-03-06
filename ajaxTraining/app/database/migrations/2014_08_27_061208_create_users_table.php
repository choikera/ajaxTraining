<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('username');
			$table->string('password');
			$table->string('firstname');
			$table->string('lastname');
            $table->string('type');
            $table->string('remember_token');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('users');
	}

}
