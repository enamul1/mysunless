<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class AlterClientTableAddCountryField extends Migration {
	
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table ( 'clients', function ($table) {
			$table->string ( 'country', 100 )->after ('state');
		} );
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table ( 'clients', function ($table) {
			$table->dropColumn ( 'country' );
		} );
	}
}
