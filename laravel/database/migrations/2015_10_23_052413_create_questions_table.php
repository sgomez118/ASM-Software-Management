<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('subject_id');
            $table->string('prompt');
            $table->string('difficulty');
            $table->string('type');
            $table->binary('image')->nullable();
            $table->timestamps();
            
            $table->foreign('subject_id')
                    ->references('id')->on('subjects');
            
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('questions');
    }
}
