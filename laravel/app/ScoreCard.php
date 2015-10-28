<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScoreCard extends Model
{
    protected $filliable = ['score'];

    public function quizes(){
    	return $this->belongsTo('App\Quiz');
    }

    public function users(){
    	return $this->belongsTo('App\User');
    }
}
