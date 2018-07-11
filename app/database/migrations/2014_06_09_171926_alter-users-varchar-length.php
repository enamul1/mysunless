<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUsersVarcharLength extends Migration {

    /**
    * Make changes to the database.
    *
    * @return void
    */
    public function up()
    {
        Schema::table('Users', function($table) {
            $table->string('app_password', 255)->after('password');
        });

        $users = User::get();

        foreach ($users as $user) {
            DB::table('Users')
                ->where('id', $user->ID)
                ->update(array('app_password' => Hash::make($user->password)));
        }
    }

    /**
     * Revert the changes to the database.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Users', function($table) {
            $table->dropColumn('app_password');
        });

    }

}
