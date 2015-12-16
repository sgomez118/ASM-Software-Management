<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\ScoreCard;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('user.students.view', ['students' => User::where('type','student')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('user.professors.student_info', ['student' => User::find($id)]);
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
        User::find($id)->delete();
        return redirect('/student');
    }

    /**
     * Return list os student scores
     *
     * @return \Illuminate\Http\Response
     */
    public function scores($student_id)
    {
        $student = User::find($student_id);
        $scores = $student->scoreCards()->get();

        if($scores->count() == 0) 
            return 'No results to display.';
        else
            return $scores;
    }

    public function add_quiz(Request $request, $quiz_id)
    {
        $sc = new ScoreCard;
        $sc->user_id = $request->student_id;
        $sc->quiz_id = $quiz_id;
        $sc->is_available = 1;
        $sc->save();
        return redirect('/student/'.$sc->user_id);
    }

    public function remove_quiz(Request $request, $score_card_id)
    {
        $sc = ScoreCard::find($score_card_id);
        $sc->delete();
        echo "remove";
        return redirect('/student/'.$request->user_id);
    }
}
