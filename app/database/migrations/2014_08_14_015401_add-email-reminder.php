<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEmailReminder extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::table('events', function($table) {
            $table->integer('email_reminder_1')->default(0)->after('email_instruction');
            $table->integer('email_reminder_15')->default(0)->after('email_instruction');
            $table->integer('email_reminder_30')->default(0)->after('email_instruction');
            $table->integer('email_reminder_45')->default(0)->after('email_instruction');
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
        Schema::table('events', function($table) {
            $table->dropColumn('email_reminder_1');
            $table->dropColumn('email_reminder_15');
            $table->dropColumn('email_reminder_30');
            $table->dropColumn('email_reminder_45');
        });
	}

}
