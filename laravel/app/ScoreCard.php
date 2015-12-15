<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScoreCard extends Model
{
    protected $fillable = ['quiz_id', 'user_id', 'score', 'is_available'];

    private $my_questions;
    public $current_question = 0;

    public function responses() {
        return $this->hasMany('App\FreeResponse');
    }
    
    
    public function quiz(){
    	return $this->belongsTo('App\Quiz');
    }

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function questions(){
        return $this->belongsToMany('App\Question', 'student_answers')->withPivot('answer_question_id');
    }

    public function answer_questions(){
        return $this->belongsToMany('App\AnswerQuestion', 'student_answers')->withPivot('answer_question_id');
    }

    public function selected_answers($question_id)
    {
        return $this->answer_questions()->where('answer_question.question_id',
            $question_id)->get();
    }

    /**
      * This function is called when a student starts the test.
      * If the test is already started, load_questions() should be called
      * else a new set of questions will be loaded into memory.
      * @return question
    */
    public function get_questions(){
        $quiz = Quiz::find($this->quiz_id);
        $this->my_questions = $quiz->generate_questions();
        $this->store_my_questions();
        return $this->my_questions[0];
    }

    /**
      * This function stores the generated questions.
    */
    public function store_my_questions(){
        foreach ($this->my_questions as $question) {
            $this->questions()->attach($question->id);
        }
    }

    /**
      * This function loads questions that was stored in memory.
      * This is used if the user refreshes the page.
      * @return question
    */
    public function load_questions(){
        $this->my_questions = $this->questions()->groupBy('id')->get();
        return $this->my_questions[0];
    }


    /**
      * This function returns the next question of the quiz
      *  @return question
    */
    public function next(){
        if(($this->current_question + 1) >= $this->my_questions->count()){
            return null;
        }else{
            return $this->my_questions[++$this->current_question];
        }
    }

    /**
      * This function returns the previous question of the quiz
      * @return question
    */
    public function prev(){
        if(($this->current_question - 1) < 0){
            return null;
        }else{
            return $this->my_questions[--$this->current_question];
        }
    }

    /**
      * This function returns the question at the selected index position
      * @param index the question position
      * @return question
    */
    public function goto_index($index){
        if($index < 0 || $index >= $this->my_questions->count()){
            return null;
        }else{
            $this->current_question = $index;
            return $this->my_questions[$this->current_question];
        }
    }



}
