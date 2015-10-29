<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $fillable = ['class_id', 'description', 'quizTime', 'startDate', 'endDate'];
    
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
