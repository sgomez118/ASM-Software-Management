<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('classes', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->string('term');
            $table->integer('lecturer_id')->unsigned();
            $table->foreign('lecturer_id')->references('id')->on('classes');
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
        Schema::drop('classes');
    }
}
