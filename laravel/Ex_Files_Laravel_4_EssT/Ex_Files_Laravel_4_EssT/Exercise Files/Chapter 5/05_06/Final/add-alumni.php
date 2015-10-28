<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAlumni extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('paintings', function($newcolumn) {
            $newcolumn->boolean('alumni');        });

    }

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('paintings', function($newcolumn) {
            $newcolumn->dropcolumn('alumni');
        });
	}

}
