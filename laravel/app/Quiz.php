<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quiz extends Model
{
    protected $fillable = ['subject_id', 'user_id', 'title', 'quiz_time', 'num_of_questions', 
        'start_date', 'end_date', 'num_of_easy', 'num_of_medium', 'num_of_hard'];
    
    use SoftDeletes;
    
    public function questions()
    {
        return $this->belongsToMany('App\Question');
    }

    public function subject()
    {
        return $this->belongsTo('App\Subject');
    }
    
    public function scoreCards()
    {
        return $this->hasMany('App\ScoreCard');
    }
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
}
