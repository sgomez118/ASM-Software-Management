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
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        
        $questions = Question::paginate(5);

        return view('question.view', ['questions' => $questions]);
        
       // return view('question.view', ['questions' => Question::all()]);

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
    
    public function create_free_response(Request $request)
    {
        return view('question.create_free_response');
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
        $question->total_score = $request->total_score;
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
        return redirect('/question');
    }
    
    public function store_free_response(Request $request)
    {
        $question = new Question;
        $question->prompt = $request->prompt;
        $question->difficulty = $request->difficulty;
        $question->subject_id = 1;
        $question->type = 'free-response';
        $question->save();
        
        $a1 = new Answer;
        $a1->text = $request->choice1;
        $a1->save();
        $question->answers()->attach($a1->id, array('is_correct' => 0));
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
        // display an individual question
        // get the question to display
        $question = Question::find($id);
        
        // pass it to the view
        return view('question.show', ['question' => $question]);
        //return Question::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = Question::find($id);
        return view('question.edit', ['question' => $question]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     
     // WARNING: Request $request was originally first parameter
    public function update(Request $request, $id)
    {
        // the form sends the request
        // the id indicates which question to update
        
        // store
            $question = Question::find($id);
            $question->prompt = $request->input('prompt'); // works! 
            
            // what happens if we leave it unselected? 
            // nice, doesn't change it if nothing selected
            // I think it has the previous selected
            $question->difficulty = $request->input('difficulty'); // works!
            $question->total_score = $request->input('total_score'); // works!
            
            $question->save();
            
            // detach all answers from the question
            // attach the newly created ones from the form; overwrites.  
            
            $question->answers()->detach(); // detach all answers from question
            
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
            
            // question now has the new answers attached to it.  
            
            
            // need this line or else it redirects to the non-GET URL
            // it has a PUT request instead, so nothing displays
            // because there is no view associated with a PUT
            // YES IT WORKS
            // THAT IS WHAt I AM TALKING ABOUT
            
            return view('question.show', ['question' => $question]);
            
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // retrieve model from database and delete it
        $question = Question::find($id);
        $question->delete(); 
        
        // after deletion, redirect
        return redirect('/question');
    }
}
