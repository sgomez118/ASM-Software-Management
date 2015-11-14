<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnswerQuestion extends Model
{
    // still in progress
    protected $fillable = ['question_id', 'answer_id', 'is_correct'];
    
    // establish the correct relationships
    
    // without override, it will look for AnswerQuestion_ScoreCard' or something else
    public function score_cards(){
        $this->belongsToMany('App\ScoreCard', 'student_answer');
    }
}
