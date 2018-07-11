<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterEventsTableAddAddressZipCityState extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('events', function($table) {
			$table->string('address')->after('to_time');
			$table->string('zip')->after('address');
			$table->string('city')->after('zip');
			$table->string('state')->after('city');
            
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('events', function($table) {
			$table->dropColumn('address');
			$table->dropColumn('zip');
			$table->dropColumn('city');
			$table->dropColumn('state');
            
        });
	}

}
