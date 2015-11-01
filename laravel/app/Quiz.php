<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    // changed to course_id (originally class_id)
    protected $fillable = ['course_id', 'description', 'quizTime', 'startDate', 'endDate'];
    
    public $timestamps = false;
    
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
        return $this->belongsTo('App\Class');
    }
    
}
