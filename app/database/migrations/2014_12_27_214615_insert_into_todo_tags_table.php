<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertIntoTodoTagsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::table('todo_tags')->insert(array('todo_tag' => 'Important', 'created_at' => date("Y-m-d H:i:s")));
        DB::table('todo_tags')->insert(array('todo_tag' => 'Urgent', 'created_at' => date("Y-m-d H:i:s")));
        DB::table('todo_tags')->insert(array('todo_tag' => 'Regular', 'created_at' => date("Y-m-d H:i:s")));
        DB::table('todo_tags')->insert(array('todo_tag' => 'Minor', 'created_at' => date("Y-m-d H:i:s")));
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::truncate('todo_tags');
	}

}
