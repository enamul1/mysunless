<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('Users', function($table) {
			$table->enum('company_type',array('MOBILE_TANNING_BUSSINESS','SALON_BASED_BUSINESS', 'NULL'))->default('NULL')->after('company');
            $table->string('company_website')->after('company_type');            
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
			$table->dropColumn('company_type');
			$table->dropColumn('company_website');
		});
	}

}
