<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SettingsTable extends Migration {

    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('settings', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('setting_type');
            $table->string('name');
            $table->string('value');
            $table->timestamps();
            $table->softDeletes();
        });

        DB::table('settings')->insert(array('setting_type' => 'WEB_SETTINGS', 'name' => 'SITE_NAME', 'value' => 'MySunless'));
        DB::table('settings')->insert(array('setting_type' => 'WEB_SETTINGS', 'name' => 'SITE_URL', 'value' => 'http://mysunless.com'));
        DB::table('settings')->insert(array('setting_type' => 'SETTINGS', 'name' => 'EMAIL_INSTRUCTION', 'value' => 'Please be prepared yourself before coming'));


        Schema::table('events', function($table) {
            $table->text('email_instruction')->after('cost');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('settings');
        Schema::table('events', function($table) {
            $table->dropColumn('email_instruction');
        });
    }

}
