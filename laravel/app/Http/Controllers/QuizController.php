<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Quiz;
use App\Question;
use App\User;
use Auth;
use DateTime;
use App\ScoreCard;

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
        $quiz->user_id = Auth::user()->id;
        $quiz->subject_id = $request->subject_id;
        $quiz->title = $request->title;
        $quiz->quiz_time = $request->quiz_time;
        $formatedStart = DateTime::createFromFormat('m/d/Y h:i a', $request->start_date);
            $quiz->start_date =  $formatedStart->format("Y-m-d H:i:s");
        $formatedEnd = DateTime::createFromFormat('m/d/Y H:i a', $request->end_date);
            $quiz->end_date = $formatedEnd->format("Y-m-d H:i:s");
        $quiz->num_of_questions = $request->num_of_questions;
        $quiz->percentage_easy = $request->percentage_easy;
        $quiz->percentage_medium = $request->percentage_medium;
        $quiz->percentage_hard = $request->percentage_hard;
        $quiz->save();        
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
        return view('quiz.takeQuiz');
        /*$user = User::find($id);
        switch ($user->type) {
            case 'student':
                // return view('user.student.quizzes');
            
            case 'lecturer':
                return view('user.lecturer.quizzes');
            case 'chair':
                return view('user.chair.quizzes');
            default:
                return redirect('/');
        }*/
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $quiz = Quiz::find($id);
        return view('quiz.edit', ['quiz' => $quiz]);
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
        $quiz = Quiz::find($id);
        $quiz->class_id = $request->class_id;
        $quiz->description = $request->description;
        $quiz->quizTime = $request->quizTime;
        $quiz->startDate = $request->startDate;
        $quiz->endDate = $request->endDate;
        $quiz->save();
        return redirect('/quizzes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Quiz::destroy($id);
        return redirect('/quizzes');
    }
}
