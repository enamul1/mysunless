<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessToolsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('business_tools', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('business_tool_type_id');
            $table->string('name');
            $table->text('description');
            $table->string('uploaded_file');
            $table->string('link',1000);
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
		Schema::drop('business_tools');
	}

}
