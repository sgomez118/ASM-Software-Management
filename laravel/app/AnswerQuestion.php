<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnswerQuestion extends Model
{
    protected $fillable = ['question_id', 'answer_id', 'is_correct'];
    protected $table = 'answer_question';

    public function score_cards(){
        return $this->belongsToMany('App\ScoreCard');
    }

}
