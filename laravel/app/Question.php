<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['subject_id', 'prompt', 'difficulty', 'type', 'image'];
    use SoftDeletes;
    
    public function answers(){
    	return $this->belongsToMany('App\Answer')->withPivot('is_correct');
    }
    
    public function quizzes(){
        return $this->belongsToMany('App\Quiz');
    }
}
