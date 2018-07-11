<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrateTodoStatusTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('todo_status', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('status');
        });
		DB::table('todo_status')->insert(array('status' => 'Pending'));
		DB::table('todo_status')->insert(array('status' => 'Completed'));
		DB::table('todo_status')->insert(array('status' => 'Overdue'));
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('todo_tags');
	}

}
