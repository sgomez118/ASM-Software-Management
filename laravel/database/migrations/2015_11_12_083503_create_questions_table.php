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
            $table->softDeletes();
            $table->increments('id')->unsigned();
            $table->integer('subject_id')->unsigned();
            $table->longtext('prompt');
            $table->string('difficulty');
            $table->string('type');
            $table->binary('image')->nullable();
            $table->double('total_score');
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
