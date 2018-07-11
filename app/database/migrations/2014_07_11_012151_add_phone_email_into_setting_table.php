<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPhoneEmailIntoSettingTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::table('settings')->insert(array('setting_type' => 'CONTACT', 'name' => 'PHONE', 'value' => '485121255'));
        DB::table('settings')->insert(array('setting_type' => 'CONTACT', 'name' => 'EMAIL', 'value' => 'enamul.promy@gmail.com'));
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::table('settings')->where('name', 'PHONE')->delete();
		DB::table('settings')->where('name', 'EMAIL')->delete();
	}

}
