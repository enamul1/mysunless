<?php

use Illuminate\Database\Migrations\Migration;

class AddNewColumnsToUsers extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('Users', function($table) {
			$table->integer('users_role');
            $table->softDeletes();
            $table->timestamps();
            
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
			$table->dropColumn('users_role');
			$table->dropColumn('deleted_at');
			$table->dropColumn('created_at');
			$table->dropColumn('updated_at');
		});
	}

}
