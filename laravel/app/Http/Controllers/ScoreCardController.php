<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\ScoreCard;
use App\Quiz;
use App\Question;
use App\FreeResponse;

class ScoreCardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * Assumption: All quesitons are multi-value,
     *      Questions are in the database already
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $scoreCard = session('score_card'); 
        
        if (Question::find($request->qID)->type == 'free-response')
        {
            $free_response;
            $question = Question::find($request->qID);
            if ($scoreCard->responses()->where('question_id', $question->id)->count() >= 1)
            {
                $free_response_id = $scoreCard->responses()->where('question_id', $question->id)->first()->id;
                $free_response = FreeResponse::find($free_response_id);
                
            }
            else 
            {
                $free_response = new FreeResponse; 
            }
            $free_response->question_id = $request->qID;
            $free_response->response = $request->response;
            $free_response->score_card_id = $scoreCard->id;
            $free_response->save();
            
            $scoreCard->responses()->save($free_response);
        }
        else {
            
        $answers = $scoreCard->answer_questions()->wherePivot('question_id', '=', $request->qID)->get();
        $student_response = $scoreCard->questions()->where('questions.id', '=', $request->qID)->get();

        $studentAnswers = array();
        foreach (Question::find($request->qID)->answers()->get() as $a) {
            if($request->has('cb'.$a->pivot->id)){
                array_push($studentAnswers, $a->pivot->id);
            }
        }

        if(count($studentAnswers) > 0){
            // echo "detaching...<br>";
            $scoreCard->questions()->detach($request->qID);
            foreach ($studentAnswers as $a) {
                // echo "attaching...".$a."<br>";
                $scoreCard->questions()->attach($request->qID, array('answer_question_id' => $a));
            }
        }else{
            $scoreCard->questions()->detach($request->qID);
            $scoreCard->questions()->attach($request->qID, array('answer_question_id' => null));
        }
        }
        
        if($request->has('next')){
            $question = $scoreCard->next();
            if($question != null){
                return $this->goto_qustion($question, $scoreCard);                
            }else{
                return redirect('/finished_quiz');
            }

        }

        if ($request->has('prev')){
            $question = $scoreCard->prev();
            if($question != null){
                return $this->goto_qustion($question, $scoreCard);
            }
        }
    }

    private function goto_qustion($question, $scoreCard)
    {
        if($question->type !== "free-response")
                {
                    return view('scorecard.take', ['question' => $question, 'question_count' => 1,
                        'selected_answers' => $scoreCard->answer_questions()->
                            where('answer_question.question_id', $question->id)->get()
                            ]);
                }
                else
                {
                    $response = FreeResponse::where('question_id', $question->id)->
                        where('score_card_id', $scoreCard->id)->get()->first();
                    return view('scorecard.take', ['question' => $question, 
                        'free_response' => $response, 'question_count' => 1]);
                }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Get the score card associated with the ID
        // WARNING: this is the actual ID, NOT user id!!!
        $scoreCard = ScoreCard::find($id); 
      
        // return a view with the scoreCard passed to it
        return view('scorecard.view', ['scoreCard' => $scoreCard]);
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

    public function take_quiz(){
        $scoreCard = ScoreCard::find(session("scorecardID"));
        $first_question;
        if($scoreCard->questions()->count() > 0){
            $first_question = $scoreCard->load_questions();
        }else{
            $first_question = $scoreCard->get_questions();
        }
        session(['score_card' => $scoreCard]);
        return view('scorecard.take', ['question' => $first_question, 
          'selected_answers' => $scoreCard->selected_answers($first_question->id)]);
    }

    public function grade_quiz(Request $request)
    {
        $scoreCard = $request->session()->get('score_card'); 
        $num_correct = 0;
        $num_of_questions = $scoreCard->questions()->groupBy('id')->get()->count();
        foreach ($scoreCard->questions()->groupBy('id')->get() as $q) {
            $correct_answers = $q->answers()->select('answer_question.id')->wherePivot('is_correct', '=', 1)->get();
            $student_answers = $scoreCard->answer_questions()->select('answer_question_id')->wherePivot('question_id', '=', $q->id)->get();
            $correct_ids = array();
            $student_ids = array();

            foreach ($correct_answers as $correct_answer) {
                array_push($correct_ids, $correct_answer->id);
            }
            foreach ($student_answers as $student_answer) {
                array_push($student_ids, $student_answer->answer_question_id);
            }
            if($correct_ids == $student_ids){
                $num_correct++;
            }
        }
        
        $scoreCard->multi_choice_score = $num_correct;
        $scoreCard->is_available = 0;
        $scoreCard->save();

        return view('scorecard.finished', ['scorecard' => $scoreCard]);
        

    }
  
}
