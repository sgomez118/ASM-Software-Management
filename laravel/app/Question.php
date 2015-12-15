<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    protected $fillable = ['subject_id', 'prompt', 'difficulty', 'type', 'image', 'total_score'];
    use SoftDeletes;
    
    public function responses()
    {
        return $this->hasMany('App\FreeResponse');
    }
    
    public function answers(){
    	return $this->belongsToMany('App\Answer')->withPivot('id','is_correct');
    }
    
    public function quizzes(){
        return $this->belongsToMany('App\Quiz');
    }

    public function scoreCards(){
        return $this->belongsToMany('App\ScoreCard');
    }
}
