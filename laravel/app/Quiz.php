<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quiz extends Model
{
    protected $fillable = ['subject_id', 'user_id', 'title', 'quiz_time', 'num_of_questions', 
        'start_date', 'end_date', 'num_of_easy', 'num_of_medium', 'num_of_hard'];
    
    use SoftDeletes;
    
    public function questions()
    {
        return $this->belongsToMany('App\Question');
    }

    public function subject()
    {
        return $this->belongsTo('App\Subject');
    }
    
    public function scoreCards()
    {
        return $this->hasMany('App\ScoreCard');
    }
    
    //This funtion yeilds the quiz creator
    public function user()
    {
        return $this->belongsTo('App\User');
    }



    /**
     * Returns a list of quiz qustions based on quiz id.
     * Currently assumes that questions are in quiz bank and if there aren't enough
     * it returns all the questions that are in the bank.
     * This can be improved with futher thought.
     * @param int $id
     * @return list of question for quiz
     */
    public function generate_questions()
    {
        $allQuestions;
        $easyInDB = Question::where('difficulty', 'easy')->get()->count();
        $medInDB = Question::where('difficulty', 'medium')->get()->count();
        $hardInDB = Question::where('difficulty', 'hard')->get()->count();
        $freeInDB = Question::where('type', 'free-response')->get()->count();


        if($easyInDB != 0 && $this->num_of_easy != 0){
            if($this->num_of_easy > $easyInDB){
                $allQuestions = Question::where('type','<>','free-response')->where('difficulty', 'easy')->orderByRaw('RAND()')->take($easyInDB)->get();
            }else{
                $allQuestions = Question::where('type','<>','free-response')->where('difficulty', 'easy')->orderByRaw('RAND()')->take($this->num_of_easy)->get();
            }
        }
        

        if($medInDB != 0 && $this->num_of_medium != 0){
            if($this->num_of_medium > $medInDB){
                $allQuestions = $allQuestions->merge(Question::where('type','<>','free-response')->where('difficulty', 'medium')->orderByRaw('RAND()')->take($medInDB)->get());
            }else{
                $allQuestions = $allQuestions->merge(Question::where('type','<>','free-response')->where('difficulty', 'medium')->orderByRaw('RAND()')->take($this->num_of_medium)->get());
            }
        }

        if($hardInDB != 0 && $this->num_of_hard != 0){
            if($this->num_of_hard > $hardInDB){
                $allQuestions = $allQuestions->merge(Question::where('type','<>','free-response')->where('difficulty', 'hard')->orderByRaw('RAND()')->take($hardInDB)->get());
            }else{
                $allQuestions = $allQuestions->merge(Question::where('type','<>','free-response')->where('difficulty', 'hard')->orderByRaw('RAND()')->take($this->num_of_hard)->get());
            }
        }

        if($freeInDB != 0 && $this->num_of_free_response != 0){
            if($this->num_of_free_response > $freeInDB){
                $allQuestions = $allQuestions->merge(Question::where('type','free-response')->orderByRaw('RAND()')->take($freeInDB)->get());
            }else{
                $allQuestions = $allQuestions->merge(Question::where('type','free-response')->orderByRaw('RAND()')->take($this->num_of_free_response)->get());
            }
        }

        return $allQuestions;
    }
    
}
