<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUserTableHasPhoto extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('Users', function($table) {
            $table->enum('has_photo',array('Y','N'))->default('N')->after('company');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('Users', function($table) {
            $table->dropColumn('has_photo');
        });
	}

}
