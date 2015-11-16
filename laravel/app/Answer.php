<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = ['text', 'image'];

    public function questions(){
    	return $this->belongsToMany('App\Question')->withPivot('id','is_correct');
    }
}
