<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = ['text', 'image', 'isCorrect'];

    public function questions(){
    	return $this->belongsToMany('App\Question');
    }
}
