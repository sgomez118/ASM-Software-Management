<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizzesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('quizzes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('subject_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('title');
            $table->integer('quiz_time');
            $table->integer('num_of_questions');
            $table->dateTime('start_date');
            $table->dateTime('end_date'); 
            $table->double('percentage_easy');
            $table->double('percentage_medium');
            $table->double('percentage_hard');
            
            $table->foreign('subject_id')
                    ->references('id')->on('subjects');
            $table->foreign('user_id')
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
        Schema::drop('quizzes');
    }
}
