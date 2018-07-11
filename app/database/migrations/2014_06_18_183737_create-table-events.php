<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableEvents extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::create('events', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('customer_id');
            $table->string('client_id');
            $table->dateTime('from_time');
            $table->dateTime('to_time');
            $table->string('location');
            $table->string('cost');
            $table->timestamps();
            $table->softDeletes();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
        Schema::drop('events');
	}

}
