<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Quiz;
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
        $quiz->class_id = $request->class_id;
        $quiz->description = $request->description;
        $quiz->quizTime = $request->quizTime;
        $quiz->startDate = $request->startDate;
        $quiz->endDate = $request->endDate;
        $quiz->save();
        return redirect('/quizzes');
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
