<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSecurexTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('securex', function(Blueprint $table)
		{
			$table->increments('id');
            $table->tinyInteger('user_id');
            $table->string('name');
            $table->string('gender');
            $table->string('mobile', 20);
            $table->string('email');
            $table->string('personal_id', 19);
            $table->string('date_of_birth');
            $table->string('role');
            $table->string('workstation');
            $table->string('present_address1');
            $table->string('present_address2');
            $table->string('permanent_address1');
            $table->string('permanent_address2');
            $table->string('attachment');
            $table->string('photo');
            $table->tinyInteger('status')->default('0');
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
		Schema::drop('securex');
	}

}
