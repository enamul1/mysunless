<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersRoleTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        //
        Schema::create('users_role', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('role');
            $table->timestamps();
        });
        DB::table('users_role')->insert(array('role' => 'admin'));
        DB::table('users_role')->insert(array('role' => 'client'));
        DB::table('users_role')->insert(array('role' => 'customer'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('users_role');
    }


}
