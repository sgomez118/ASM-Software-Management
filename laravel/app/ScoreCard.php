<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScoreCard extends Model
{
    protected $fillable = ['score'];

    public function quizzes(){
    	return $this->belongsTo('App\Quiz');
    }

    public function users(){
    	return $this->belongsTo('App\User');
    }

}
