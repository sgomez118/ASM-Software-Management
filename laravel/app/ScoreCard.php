<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScoreCard extends Model
{
    protected $fillable = ['quiz_id', 'user_id', 'score', 'is_taken'];

    public function quizzes(){
    	return $this->belongsTo('App\Quiz');
    }

    public function users(){
    	return $this->belongsTo('App\User');
    }
    
    // ScoreCard belongs to many AnswerQuestions
    // we customize the name of the pivot table that connects the two
    // the pivot table name is 'student_answer'
    // this overrides the default name that Laravel will look for 
    public function answer_questions(){
        return $this->belongsToMany('App\AnswerQuestion', 'student_answer');
    }

}
