<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Quiz;
use App\Question;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Quiz::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('quiz.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $quiz = new Quiz;
        $quiz->course_id = $request->course_id;
        $quiz->description = $request->description;
        $quiz->quizTime = $request->quizTime;
        $quiz->startDate = $request->startDate;
        $quiz->endDate = $request->endDate;
        $quiz->save();
        /**
        $question = new Question;
        $question->prompt = 'Sample Prompt!';
        $question->difficulty = 'easy';
        $question->save();
        
        $a1 = new Answer;
        $a2 = new Answer;
        $a3 = new Answer;
        $a4 = new Answer;
        $a5 = new Answer;
        
        $a1->text = 'Answer Choice 1';
        $a2->text = 'Answer Choice 2';
        $a3->text = 'Answer Choice 3';
        $a4->text = 'Answer Choice 4';
        $a5->text = 'Answer Choice 5';

        $a1->isCorrect = 1;
        $a2->isCorrect = 0;
        $a3->isCorrect = 0;
        $a4->isCorrect = 0;
        $a5->isCorrect = 0;
        
        $a1->save();
        $a2->save();
        $a3->save();
        $a4->save();
        $a5->save();
        */
        // still need to add the questions from question bank
        // see QuestionController to see how we added a whole bunch of answers for each question without changing the schema (we will need to change it eventually)
        
        // for now, we can just randomly pull from the database
        // generate a random integer using some PHP function
        // then... 
        /**
        $question1 = Question::find(1);
        $question2 = Question::find(2);
        $question3 = Question::find(3);
        */
        /*
        $quiz->questions()->sync(array($question1->id, $question2->id, $question3->id));
        */
        
        
        $question = Question::select('id')->orderByRaw("RAND()")->take(3)->get(); 
        
        // get the questions in random order
        // we get a whole bunch of questions from the above
        // now, how do we put them into an array?
        // we want to fill the array with $question->id
        // (each question's ID)
        $quiz->questions()->sync($question);
        
        return redirect('/view_quizzes');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    
}
