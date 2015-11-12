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
            $table->integer('score_card_id')->unsigned();
            
            $table->foreign('answer_question_id')
                    ->references('id')->on('answer_question');
            $table->foreign('score_card_id')
                    ->references('id')->on('score_cards');
            
            
            
            $table->timestamps();
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
