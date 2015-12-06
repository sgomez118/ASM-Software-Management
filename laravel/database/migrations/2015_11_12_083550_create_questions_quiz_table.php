<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsQuizTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_quiz', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('quiz_id')->unsigned();
            $table->integer('question_id')->unsigned();
            //Defining Foreign Relationships
            $table->foreign('quiz_id')
                    ->references('id')->on('quizzes');
            $table->foreign('question_id')
                    ->references('id')->on('questions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('question_quiz');
    }
}
