<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['prompt', 'difficulty'];

    public function answers(){
    	return $this->belongsToMany('App\Answer');
    }
    
    public function quizzes() {
        return $this->belongsToMany('App\Quiz');
    }
}
