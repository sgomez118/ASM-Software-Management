<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    protected $fillable = ['subject_id', 'prompt', 'difficulty', 'type', 'image'];
    use SoftDeletes;
    
    public function answers(){
    	return $this->belongsToMany('App\Answer')->withPivot('id','is_correct');
    }
    
    public function quizzes(){
        return $this->belongsToMany('App\Quiz');
    }
}
