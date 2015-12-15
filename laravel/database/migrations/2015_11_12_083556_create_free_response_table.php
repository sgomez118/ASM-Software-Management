<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFreeResponseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('free_response', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('question_id')->unsigned();
            $table->integer('graded_by')->unsigned();
            $table->longtext('response');
            $table->double('actual_score');
            $table->timestamps();
            
            $table->foreign('question_id')
                    ->references('id')->on('questions');
            $table->foreign('graded_by')
                    ->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('free_response');
    }
}
