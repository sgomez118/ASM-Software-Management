<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScoreCard extends Model
{
    protected $fillable = ['quiz_id', 'user_id', 'score', 'is_taken'];

    public function quiz(){
    	return $this->belongsTo('App\Quiz');
    }

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function answer_questions(){
        return $this->belongsToMany('App\AnswerQuestion', 'student_answers');
    }

}
