<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = ['text', 'image'];
    use SoftDeletes;

    public function questions(){
    	return $this->belongsToMany('App\Question')->withPivot('is_correct');
    }
}
