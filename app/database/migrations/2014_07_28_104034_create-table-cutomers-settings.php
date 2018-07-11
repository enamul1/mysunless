<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCutomersSettings extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('customers_settings', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('customer_id');
            $table->text('email_instructions');
            $table->float('default_cost');
            $table->enum('reminder_15', array(0,1))->default(0);
            $table->enum('reminder_30', array(0,1))->default(0);
            $table->enum('reminder_45', array(0,1))->default(0);
            $table->text('reminder_message');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('customers_settings');
    }

}
