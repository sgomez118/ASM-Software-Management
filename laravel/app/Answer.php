<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = ['text', 'image'];
    // protected $fillable = ['text', 'image', 'isCorrect'];

    // look at all the questions that the answer belongs to 
    // and include the "is_correct' column 
    public function questions(){
    	return $this->belongsToMany('App\Question')->withPivot('is_correct');
    }
}
