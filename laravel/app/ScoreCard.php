<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScoreCard extends Model
{
    protected $fillable = ['quiz_id', 'user_id', 'score', 'is_taken'];

    private $my_questions;
    private $current_question = 0;

    public function quiz(){
    	return $this->belongsTo('App\Quiz');
    }

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function questions(){
        return $this->belongsToMany('App\Question', 'student_answers');
    }

    public function answer_questions(){
        return $this->belongsToMany('App\AnswerQuestion', 'student_answers');
    }

    /**
     * Returns a list of quiz qustions based on quiz id.
     * Currently assumes that questions are in quiz bank and if there aren't enough
     * it returns all the questions that are in the bank.
     * This can be improved with futher thought.
     * @param int $id
     * @return list of question for quiz
     */
    public function generateQuestions()
    {
        $quiz = Quiz::find($this->quiz_id);
        $allQuestions;
        $easyInDB = Question::where('difficulty', 'easy')->get()->count();
        $medInDB = Question::where('difficulty', 'medium')->get()->count();
        $hardInDB = Question::where('difficulty', 'hard')->get()->count();


        if($easyInDB != 0 && $quiz->num_of_easy != 0){
            if($quiz->num_of_easy > $easyInDB){
                $allQuestions = Question::where('difficulty', 'easy')->orderByRaw('RAND()')->take($easyInDB)->get();
            }else{
                $allQuestions = Question::where('difficulty', 'easy')->orderByRaw('RAND()')->take($quiz->num_of_easy)->get();
            }
        }
        

        if($medInDB != 0 && $quiz->num_of_medium != 0){
            if($quiz->num_of_medium > $medInDB){
                $allQuestions = $allQuestions->merge(Question::where('difficulty', 'medium')->orderByRaw('RAND()')->take($medInDB)->get());
            }else{
                $allQuestions = $allQuestions->merge(Question::where('difficulty', 'medium')->orderByRaw('RAND()')->take($quiz->num_of_medium)->get());
            }
        }

        if($hardInDB != 0 && $quiz->num_of_hard != 0){
            if($quiz->num_of_hard > $hardInDB){
                $allQuestions = $allQuestions->merge(Question::where('difficulty', 'hard')->orderByRaw('RAND()')->take($hardInDB)->get());
            }else{
                $allQuestions = $allQuestions->merge(Question::where('difficulty', 'hard')->orderByRaw('RAND()')->take($quiz->num_of_hard)->get());
            }
        }

        $this->my_questions = $allQuestions;
        return $this->my_questions[0];
    }

    public function store_my_questions(){
        foreach ($this->my_questions as $question) {
            echo "Storing: ".$question->id;
            $this->questions()->attach($question->id);//null, array("question_id" => $question->id));
        }
    }

    public function next()
    {
        if(($this->current_question + 1) >= $this->my_questions->count()){
            return null;
        }else{
            return $this->my_questions[++$this->current_question];
        }
    }

    public function prev()
    {
        if(($this->current_question - 1) < 0){
            return null;
        }else{
            return $this->my_questions[--$this->current_question];
        }
    }



}
