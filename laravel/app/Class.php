<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Class extends Model
{
    $fillable = ['name', 'term'];
    
    public function quizzes()
    {
        $this->hasMany('App\Quiz');
    }
    
    public function users()
    {
        $this->hasMany('App\User');
    }
}
