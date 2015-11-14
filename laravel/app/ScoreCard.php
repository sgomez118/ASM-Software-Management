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

    public function answer_questions(){
        return $this->belongsToMany('App\AnswerQuestion');
    }

}
