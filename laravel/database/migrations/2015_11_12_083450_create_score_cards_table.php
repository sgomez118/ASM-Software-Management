<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScoreCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('score_cards', function (Blueprint $table) {
            $table->increments('id');
            $table->double('score');
            $table->boolean('is_taken');
            $table->integer('quiz_id')->unsigned();
            $table->integer('user_id')->unsigned();
            
            $table->foreign('quiz_id')
                    ->references('id')->on('quizzes');
            $table->foreign('user_id')
                    ->references('id')->on('users');
            
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
        Schema::drop('score_cards');
    }
}
