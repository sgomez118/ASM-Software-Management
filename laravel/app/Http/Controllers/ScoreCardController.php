<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\ScoreCard;
use App\Quiz;
use App\Question;

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

    public function take_quiz(){
        $scoreCard = ScoreCard::find("scorecardID");
        $first_question;
        if($scoreCard->questions()->count() > 0){
            $first_question = $scoreCard->load_questions();
        }else{
            $first_question = $scoreCard->get_questions();
        }

        return view('scorecard.take', ['question' => $first_question, 
            'selected_answers' => $scoreCard->answer_questions()->where('answer_question.question_id',
            $first_question->id)->get()]);
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
        // echo "Request".$request;
        $scoreCard = $request->session()->get('score_card'); 
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

        if($request->has('next')){
            $question = $scoreCard->next();
            if($question != null){
                return view('quiz.take', ['question' => $question, 'selected_answers' => $scoreCard->answer_questions()->where('answer_question.question_id', $question->id)->get()]);
            }else{
                return redirect('/finished_quiz');
            }

        }

        if ($request->has('prev')){
            $question = $scoreCard->prev();
            if($question != null){
                return view('quiz.take', ['question' => $question, 'selected_answers' => $scoreCard->answer_questions()->where('answer_question.question_id', $question->id)->get()]);
            }
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

    public function grade_quiz(Request $request)
    {
        $scoreCard = $request->session()->get('score_card'); 
        $num_correct = 0;
        $num_of_questions = $scoreCard->questions()->groupBy('id')->get()->count();
    echo "==============================================";
    foreach ($scoreCard->questions()->groupBy('id')->get() as $q) {
        echo "<br>Question ".$q->id;
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
        // echo "<br>Correct".$correct_answers;
        // echo "<br>Student".$student_answers;
        echo "<br>----------------------------------------------";
        if($correct_ids == $student_ids){
            echo "<br>Answers: Correct<br>";
            $num_correct++;
        }else{
            echo "<br>Answers: Incorrect<br>";
        }
        foreach ($correct_answers as $a) {
            echo "id ".$a->id;   
            echo "<br>";
        }
        echo "----------------------------------------------";
        echo "<br>Student Answers:<br>";
        foreach ($student_answers as $a) {
            echo "id ".$a->answer_question_id;   
            echo "<br>";
        }
        echo "==============================================";
    }
    echo "<br>num of questions: ".$num_of_questions;
    echo "<br>num of correct: ".$num_correct;
    echo "<br>score: ".(($num_correct/$num_of_questions)*100)."%";
    }
    
    /**
     * Grade the quiz associated with this score card
     *
     * We look at two lists: the (question, answer, is_correct) 
     * triples associated with EACH question on the quiz and the
     * student responses to that quiz.  Check to see that both lists
     * are exactly same (contain exactly the same items).  
     * 
     * ScoreCard is already aware of what user it belongs to and 
     * which quiz it is for.  
     * 
     * Stackoverflow gives the following solution to compare arrays:
     * 
     * $arraysAreEqual = ($a == $b); 
     * TRUE if $a and $b have the same key-value pairs in any order
     *     
     * $arraysAreEqual = ($a === $b);
     * TRUE if $a and $b have the same key-value pairs in the same
     *     order and of the same types
     *
     * Possibilities: 
     *     Create two arrays: one with student answers, and the other
     *     with all the (question, answer, is_correct) triples and 
     *     compare the arrays.  In current version, the is_correct flag
     *     appears in the student responses
     *
     *     Create two arrays: one with student answers, and the other
     *     with only the correct (question, answer, is_correct == 1) 
     *     triples (notation is informal, not exact code).  Then do
     *     the array comparison.  Use this if there the is_correct flag
     *     does not appear in the student responses.  This should NOT
     *     happen because student answers are from answer_question
     *     table, which contains the is_correct flag.  
     *
     */
    public function gradeQuiz($scorecardID)
    {
        /** Create two arrays, insert items into them dynamically?
            Is there a nice way to just create the association in one line?
        
            $array[] = 'newItem'; inserts 'newItem' into array
            
            Another example: 
            $stack = array("orange", "banana");
            array_push($stack, "apple", "raspberry");
        */ 
        
        // get the current quiz
        //  $quiz = Quiz::find($this->quiz_id); 
        // note: this may not work because quiz generated on the fly?
      
        // the questions related to the quiz are all the questions available for that quiz
        // when a student takes a quiz, only a subset are used
        $scoreCard = ScoreCard::find(scorecardID);
        $quiz = Quiz::find($scoreCard->quiz_id);
        
        // get only the correct answers and put them into an array
        // do this for EACH question
        $correctAnswers = array(); // create array object
        
        // Array with (question ID, grade) pairs
        $scores = array();
        $totalScore = 0; // initialize total score to 0
        
        // push only the correct answers into the array
        // grade each question, put score into $scores array
        // this first foreach() loop iterates through each individual question
        foreach($quiz->questions()->get() as $question)
        {
            // get only the correct answers
            // re-initialize array to clear it
            $correctAnswers = array();
            // this loop looks at each individual answer in the question
            foreach($question->answers()->get() as $currentAnswer)
            {
                
                if($currentAnswer->pivot->is_correct == TRUE)
                {
                    array_push($correctAnswers, $currentAnswer);
                    // $correctAnswers[] = $answer;
                }
            }
            
            // get the student responses
            // re-initialize to clear 
            // studentResponses contains the responses for the question
            $studentResponses = array(); 
            foreach($this->answer_questions()->get() as $studentAnswer)
            {
                
                
                // Alternative: instead of putting the studentAnswer in there
                // let's just put the Answer object corresponding do it
                // this way, it matches the $correctAnswers array
                
                // get the student response associated with the question we are at
                if($studentAnswer->question_id == $question->id)
                {
                    // we have the matching question ID
                    // we want the Answer object associated with that question ID
                    // This is the Answer that the STUDENT selected
                  
                    $selectedAnswer = Answer::find($studentAnswer->answer_id);
                    array_push($studentResponses, $selectedAnswer);
                    
                }
                
                // only put in the studentAnswers that correspond to
                // the question ID
                /*
                if($studentAnswer->question_id == $question->id)
                {
                    array_push($studentResponses, $studentAnswer);
                    //$studentResponses[] = $studentAnswer;
                }
                */
            }
            
            /*
              $correctAnswers has only the Answer objects that are correct
              $studentResponses has only the Answer objects selected by student for
                the current question 
                
              We need to make sure that all correct answers are in $studentResponses
              AND that all studentResponses appear in $correctAnswers
              
              This is definition of set equality (set A and B equal if and only if
              they are subsets of each other)
              
              The arrays contain the same types, so we can do a clean key-value
              comparison
              
            */
            
            
            // this checks if the arrays have the exact same key-value pairs
            // regardless of the order they are in 
            // does this really work? 
            // StackOverflow link: 
            $arraysAreEqual = ($correctAnswers==$studentResponses);
            
            if ($arraysAreEqual)
            {
                // put the question id and the score
                // array(key => value)
                // for now, the total credit is 1
                // may eventually vary this number
                // got one point of credit for the question
                array_push($scores, array($question->id => 1));
                $totalScore++;
            }
            else
            {
                // arrays are not equal; no credit (0)
                array_push($scores, array($question->id => 0));
                // $totalScore is unchanged because of zero credit
            }
        }
        
        // return the $scores array?
        // we can use the $scores array to compute the actual score
        // instead of just computing it here
        
        return $scores;
        
    }
    
    /* 
    
        @param $id is the score card ID
    
    */ 
    public function grade($scoreCardID) 
    {
        //Get ScoreCard
        $scoreCard = ScoreCard::find($scoreCardID);

        //Get questions
        $questions = $sc->questions()->get();

        foreach ($questions as $question) 
        {
            echo $question;
        
            // list of answers for a particular question
            foreach(Question::find($question->id)->answers as $answer)
            {
                echo "<br>";
                echo $answer->pivot->id;
                echo "<br>";
            }
            echo "<br>";
            echo "<br>";
            
            /* Once we have the answers for each question, what next?
               We need to compare those answers to the student responses
               
            
            
            
            */ 
            
            
        //echo $answer;
        //$qID = $answer->question_id;
        // $question = Question::find($qID);

        // switch ($question->type) {
        //     case 'single-choice':
        //         # code...
        //         break;
           
        //     case 'multi-value':
        //         foreach ($question->answers as $answer) {
        //             //is answer in student_answers?

        //         }
        //         break;
           
        //     case 'free-response':
        //         # code...
        //         break;
           
        //     default:
        //         # code...
        //         break;
        // }

        # code...
        }
    
        // get the quiz for this scorecard
        // for each question in the quiz, get a list of correct answers for it
        // for the student responses, get ONLY the answers associated with the current question
        // compare the two lists; they must match EXACTLY (set equality)
        // if they match exactly, student gets credit for that question
        
        /* Alternative approach (Misha)
        
           Get the score card ID first and pass it to the grade() function
           Hardest part(?): getting list of questions
           
           Get all the student responses
           Check the question type in each response
           If the question type is "single choice" then we check the is_correct field
               if it's TRUE, student got the question right.  Else, no credit. 
           If the question type is "multiple choice" (tricky!) 
               For each question, look at ALL of the answer choices.
               Each answer choice has a flag, is_correct (TRUE / FALSE)
               Compare this list of answer choices with the list of student responses (student_answer)
               If an answer choice flagged as "false" appears as a response, no credit.
               If an answer choice flagged as "true" does NOT appear in respose, no credit
               If an answer choice flagged as "true" DOES appear, move on.
               Student only gets credit if we moved through the entire list without encountering a "no credit" response
            
            Considering changes because we are not recording the question if there was no response
                Schema change (currently implemented): add an extra column to Student_Answer containing the question ID
                Data change: when we create a question, also create a "null" response (automatically incorrect).  
                    When we create a question as a professor, we add the answers to that question, and then add another answer to that question
                    this is a "null" response (or some non-answer).  Upon quiz initialization, we fill the score card with
                    a bunch of these null responses.  When performing the grading check (look at question's answer options with the is_correct flag
                    and compare with the student responses, encountering a "null" response automatically makes the response incorrect. 
                    CONSEQUENCE: just a little bit more data per question
                    (note: if data storage was a constraint, this might not be best route, but we currently have no information on it)
                    
            Other notes: don't show correct/incorrect answers to student (think GRE, doesn't show you, just score), but we could show it professor or chair for auditing
            Inside score card controller, use Auth::User->type to check the type, then add the logic accordingly (reference one of the older controllers that did this type check)
            
            All questions now initialized in student_answer table 
            only score card id and question id get put into score card at start
            if the answer_question_id is null, it won't be right
        */

        
    }
}
