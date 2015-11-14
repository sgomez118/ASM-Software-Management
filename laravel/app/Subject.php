<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subjects extends Model
{
    protected $fillable = ['name'];

    public function users(){
    	return $this->belongsToMany('App\User');
    }

    public function quizzes(){
    	return $this->hasMany('App\Quiz');
    }
}
