<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScoreCard extends Model
{
    $fillable = ['score'];
    
    public function quizzes()
    {
        $this->belongsTo('App\Quiz');
    }
    
    public function users()
    {
        $this->belongsTo('App\User');
    }
    
}
