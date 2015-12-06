<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_answers', function (Blueprint $table) {
            $table->integer('answer_question_id')->unsigned();
            $table->integer('question_id')->unsigned();
            $table->integer('score_card_id')->unsigned();
            $table->integer('free_response_id')->unsigned();
            $table->timestamps();

            $table->foreign('answer_question_id')
                    ->references('id')->on('answer_question');
            $table->foreign('question_id')
                    ->references('id')->on('questions');
            $table->foreign('score_card_id')
                    ->references('id')->on('score_cards');
            $table->foreign('free_response_id')
                    ->references('id')->on('free_response');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('student_answers');
    }
}
