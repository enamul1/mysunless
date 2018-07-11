<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterClientTableHasPhoto extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('clients', function($table) {
            $table->enum('has_photo',array('Y','N'))->default('N')->after('private_note');
            $table->dropColumn('photo');
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
        Schema::table('clients', function($table) {
            $table->dropColumn('has_photo');
        });
	}

}
