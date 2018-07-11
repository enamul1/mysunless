<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DefaultCustomerRoleInUsers extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::table('Users', function($table) {
            $table->dropColumn('users_role');
        });

        Schema::table('Users', function($table) {
            $table->integer('users_role')->after('app_password')->default(3);
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
	}

}
