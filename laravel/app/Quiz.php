<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    $fillable = ['class_id', 'description', 'quizTime', 'startDate', 'endDate'];
    
    public function questions()
    {
        return $this->belongsToMany('App\Question');
    }
    
    public function scoreCards()
    {
        return $this->hasMany('App\ScoreCard');
    }
    
    public function classes()
    {
        return $this->belongsToMany('App\Class');
    }
    
    
}
