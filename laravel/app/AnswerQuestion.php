<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnswerQuestion extends Model
{
    protected $fillable = ['question_id', 'answer_id', 'is_correct'];

    public function score_cards(){
        $this->belongsToMany('App\ScoreCard');
    }
}
