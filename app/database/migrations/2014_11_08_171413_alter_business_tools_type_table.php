<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterBusinessToolsTypeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        DB::table('business_tools_types')->where('name', 'Posters Flyers')->update(array('name' => 'Posters'));
        DB::table('business_tools_types')->where('name', 'Print Marketing')->delete();
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
