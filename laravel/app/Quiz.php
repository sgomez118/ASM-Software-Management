<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $fillable = ['subject_id', 'user_id', 'title', 'quiz_time', 'num_of_questions', 'start_date', 'end_date', 'percentage_easy', 'percentage_medium', 'percentage_hard'];
    
    public $timestamps = false;
    
    public function questions()
    {
        return $this->belongsToMany('App\Question');
    }
    
    public function scoreCards()
    {
        return $this->hasMany('App\ScoreCard');
    }
    
    public function users()
    {
        return $this->belongsTo('App\User');
    }
    
}
