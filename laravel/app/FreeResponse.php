<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FreeResponse extends Model
{
    protected $fillable = ['question_id', 'graded_by', 'response', 'actual_score'];
    protected $table = 'free_response';
    
    public function score_card()
    {
        return $this->belongsTo('App\ScoreCard');
    }
    
    
    public function question()
    {
        return $this->belongsTo('App\Question');
    }
    
    public function graded_by()
    {
        return $this->belongsTo('App\User');
    }
    
    
}
