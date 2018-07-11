<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class VideoTypes extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::create('video_types', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
            $table->softDeletes();
        });
        DB::table('video_types')->insert(array('name' => 'How to Guides'));
        DB::table('video_types')->insert(array('name' => 'Product Guides'));
        DB::table('video_types')->insert(array('name' => 'Equipment Guides'));
        DB::table('video_types')->insert(array('name' => 'Other'));

    }

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
        Schema::drop('video_types');
	}

}
