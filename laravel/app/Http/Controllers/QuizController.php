<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
<<<<<<< HEAD
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Quiz;
use App\Question;
=======

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Quiz;
use App\User;
>>>>>>> 2faccdfb0d3002e5cb944e5a56c994bca5b2f701

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
<<<<<<< HEAD
        $quiz->course_id = $request->course_id;
=======
        $quiz->class_id = $request->class_id;
>>>>>>> 2faccdfb0d3002e5cb944e5a56c994bca5b2f701
        $quiz->description = $request->description;
        $quiz->quizTime = $request->quizTime;
        $quiz->startDate = $request->startDate;
        $quiz->endDate = $request->endDate;
        $quiz->save();
<<<<<<< HEAD
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
        
        $question = Question::find(1);
        $quiz->questions()->sync(array($question->id));
        
        return redirect('/view_quizzes');
=======
        return redirect('/quizzes');
>>>>>>> 2faccdfb0d3002e5cb944e5a56c994bca5b2f701
    }

    /**
     * Display the specified resource.
<<<<<<< HEAD
     *
=======
     * 
>>>>>>> 2faccdfb0d3002e5cb944e5a56c994bca5b2f701
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
<<<<<<< HEAD
        //
=======
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
>>>>>>> 2faccdfb0d3002e5cb944e5a56c994bca5b2f701
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
<<<<<<< HEAD
        //
=======
        $quiz = Quiz::find($id);
        return view('quiz.edit', ['quiz' => $quiz]);
>>>>>>> 2faccdfb0d3002e5cb944e5a56c994bca5b2f701
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
<<<<<<< HEAD
        //
=======
        $quiz = Quiz::find($id);
        $quiz->class_id = $request->class_id;
        $quiz->description = $request->description;
        $quiz->quizTime = $request->quizTime;
        $quiz->startDate = $request->startDate;
        $quiz->endDate = $request->endDate;
        $quiz->save();
        return redirect('/quizzes');
>>>>>>> 2faccdfb0d3002e5cb944e5a56c994bca5b2f701
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
<<<<<<< HEAD
        //
    }
    
    
=======
        Quiz::destroy($id);
        return redirect('/quizzes');
    }

>>>>>>> 2faccdfb0d3002e5cb944e5a56c994bca5b2f701
}
