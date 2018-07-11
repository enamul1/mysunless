<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableBusinessToolsType extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('business_tools_types', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
            $table->softDeletes();
        });
        DB::table('business_tools_types')->insert(array('name' => 'Graphics & Logos', 'created_at' => date("Y-m-d H:i:s")));
        DB::table('business_tools_types')->insert(array('name' => 'Seasonal Marketing', 'created_at' => date("Y-m-d H:i:s")));
        DB::table('business_tools_types')->insert(array('name' => 'Posters Flyers', 'created_at' => date("Y-m-d H:i:s")));
        DB::table('business_tools_types')->insert(array('name' => 'Flyers & Postcards', 'created_at' => date("Y-m-d H:i:s")));
        DB::table('business_tools_types')->insert(array('name' => 'Business Cards', 'created_at' => date("Y-m-d H:i:s")));
        DB::table('business_tools_types')->insert(array('name' => 'Print Marketing', 'created_at' => date("Y-m-d H:i:s")));
        DB::table('business_tools_types')->insert(array('name' => 'Client Forms', 'created_at' => date("Y-m-d H:i:s")));		
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('business_tools_types');
	}

}
