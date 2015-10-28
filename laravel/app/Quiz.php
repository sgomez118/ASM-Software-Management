<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $gaurded = ['id'];

    public function questions(){
    	return $this->belongsToMany('App\Question');
    }

    public function scoreCards(){
    	return $this->hasMany('App\ScoreCards');
    }
}
