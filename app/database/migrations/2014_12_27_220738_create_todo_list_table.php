<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTodoListTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('todo_list', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('customer_id');
            $table->string('title');
            $table->text('description');
            $table->string('tags');
            $table->integer('status');
            $table->date('due_date');
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
		Schema::drop('todo_list');
	}

}
