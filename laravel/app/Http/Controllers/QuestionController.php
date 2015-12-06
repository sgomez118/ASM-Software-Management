<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Question;
use App\Answer;
use App\User;
use Redirect;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('question.view', ['questions' => Question::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $currentType = $request->user()->type;
        if ( $request->user()->type == "lecturer" || $request->user()->type == "chair" ){
            return view('question.create');
        }else{
            return "Hey! You aren't allowed to create questions because you are a $currentType and not a lecturer!";
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $question = new Question;
        $question->prompt = $request->prompt;
        $question->difficulty = $request->difficulty;
        $question->subject_id = 1;
        $question->save();

        $a1 = new Answer;
        $a2 = new Answer;
        $a3 = new Answer;
        $a4 = new Answer;
        $a5 = new Answer;
        
        $a1->text = $request->choice1;
        $a2->text = $request->choice2;
        $a3->text = $request->choice3;
        $a4->text = $request->choice4;
        $a5->text = $request->choice5;

        $a1->save();
        $a2->save();
        $a3->save();
        $a4->save();
        $a5->save();

        $question->answers()->attach($a1->id, array('is_correct' => ($request->isCorrect1 != 1 ? 0 : 1)));
        $question->answers()->attach($a2->id, array('is_correct' => ($request->isCorrect2 != 1 ? 0 : 1)));
        $question->answers()->attach($a3->id, array('is_correct' => ($request->isCorrect3 != 1 ? 0 : 1)));
        $question->answers()->attach($a4->id, array('is_correct' => ($request->isCorrect4 != 1 ? 0 : 1)));
        $question->answers()->attach($a5->id, array('is_correct' => ($request->isCorrect5 != 1 ? 0 : 1)));

        // return Redirect::back()->withMsg('Quiz Question Created');
        return redirect('/questions');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Question::find($id);
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
