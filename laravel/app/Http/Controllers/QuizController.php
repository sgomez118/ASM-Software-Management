<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Quiz;
use App\Question;
use App\User;

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



        /*
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
        $user = User::find($id);
        switch ($user->type) {
            case 'student':
                return view('user.student.quizzes');
            case 'lecturer':
                return view('user.lecturer.quizzes');
            case 'chair':
                return view('user.chair.quizzes');
            default:
                return redirect('/');
        }
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
