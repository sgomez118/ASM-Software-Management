<?php

use App\Question;
use App\User;
use App\Http\Controllers\AuthenticationController;
use App\Http\Middleware\Authenticate;
use App\Quiz;
use App\Subject;
use App\ScoreCard;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('landing');
});

Route::get('/all_students', 'StudentController@index');

Route::get('/dashboard', function (Request $request){
	if (Auth::check()){
		switch (Auth::user()->type) {
			case 'student':
				return view('user.students.dashboard');
			case 'lecturer':
				return view('user.professors.dashboard');
			case 'chair':
				return view('user.chairs.dashboard', ['subjects' => Subject::all()]);
			default:
				return redirect('/');
			}
	}else{
		return redirect('/');
	}
});

Route::get('/take_quiz', function ()
{
	return view('quiz.question', ['questions' => Question::paginate(1)]);
});
Route::post('/finish_quiz', function (Request $request)
{
	# code...
});

Route::get('/create_quiz', 'QuizController@create');
Route::post('/save_quiz', 'QuizController@store');

Route::get('/classes', 'CourseController@index');

Route::get('/users', [ 'middleware' => 'auth', 'uses' => 'UserController@index' ]);

Route::get('/questions', [ 'middleware' => 'auth', 'uses' =>  'QuestionController@index' ]);

Route::get('/questions/{id}', [ 'middleware' => 'auth', 'uses' =>  'QuestionController@show' ]);

Route::get('/student/{student_id}/scores', 'StudentController@scores');

Route::get('/create_question', [ 'middleware' => 'auth', 'uses' => 'QuestionController@create']);

Route::post('/save_question', 'QuestionController@store');

Route::resource('student', 'StudentController');
Route::resource('quiz', 'QuizController');

Route::get('/test', function (){
    $scoreCard = ScoreCard::find(1);
    // $answers = ScoreCard::find(1)->answer_questions()->get();
    $answers = $scoreCard->answer_questions()->get();
    echo $scoreCard->user->first_name; //Get Name
    echo "<br>";
    foreach ($answers as $a) {
    	echo $a->id;
    	echo "<br>";
    }
    echo "<br>";
    $users = User::all();
    foreach ($users as $u) {
    	$s = $u->scoreCards()->get();
    	echo "User: ";
    	echo $u->first_name;
    	echo "<br>";
    	foreach ($s as $c) {
    	echo $c->id;
    	echo "<br>";
    		# code...
    	}
    }

});

// Authentication routes...
Route::get('/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

// Password reset link request routes...
Route::get('email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

// this needs to be modified so that quizzes can be viewed
Route::get('/view_quizzes', function () {
	$quizzes = Quiz::all();
    return view('quiz.view', ['quizzes' => $quizzes ]);
});

Route::get('/view_users', function() {
    $users = User::all();
    return view('user.view', ['users' => $users]);
});
Route::get('/t', function ()
{
    return User::find(1)->scoreCards()->get();
});

Route::get('/scorecard/questions/{scorecardID}', function ($scorecardID)
{
    //Get ScoreCard
    $sc = ScoreCard::find($scorecardID);

    //Get questions
    $questions = $sc->questions()->get();

    foreach ($questions as $question) 
    {
        echo $question;
       
        // list of answers for a particular question
        
        /*  we cycle through each ANSWER for the question

            Suppose the question we are looking at is Question 3 (ID is 3)
            It has answer choices with answer ID 1,2,3,4,5
           
            Question 3: what is 2 + 2? 
            Answer 1: 3 (is_correct == 0)
            Answer 2: 4 (is_correct == 1)
            Answer 3: 5 (is_correct == 0)
            Answer 4: 6 (is_correct == 0)
            Answer 5: 7 (is_correct == 0)
            
            Student Response: 
            Answer 1: not selected
            Answer 2: selected
            Answer 3: not selected
            Answer 4: not selected
            Answer 5: not selected
            
            
            
            
           
            Now, to grade this question, we want to compare the answers to the student's response
            I am not yet aware of a clean way to do this, so I am going to brute force it. 
            Algorithm: 
                Start at Answer 1.
                Compare it to ALL of the student's responses.
                We only care about the student responses associated with question 3
                So we IGNORE all of the student responses associated with other questions
                
                
                
                
                
                ---> If we encounter a student response to another question, ignore it.
                ---> If we encounter a student response to the current question, do the following:
                    ---> If the answer is correct (is_correct ==1), check the answer_question_id
                            If the answer_question_id is null, it means the student did NOT select that answer choice
                            So the student automatically gets the question wrong because a correct answer choice was
                            missing from his response.  
                            
                            If the answer_question_id is not null, then the answer choice was selected.
                            Don't do anything yet; it may be the case that more answer choices need to be selected
                            This means that we need to perform a check: if we are at the last answer choice for that question,
                            and this check passed, then the student got the question right
                            
                    ---> If the answer is NOT correct (is_correct == 0), 
           
           


        */ 
        foreach(Question::find($question->id)->answers as $a)
        {
           echo "<br>";
           echo "Current Answer ID is: ";
           echo $a->pivot->id;
           echo "<br>";
           echo "Is this Answer a correct answer choice? (1 for yes, 0 for no): ";
           echo $a->pivot->is_correct;
           // compare this to a student's response
           // we need the student's response for this question
           // first, let's display the student's responses
           // then we'll display them based on the question ID
           foreach($sc->answer_questions()->get() as $studentAnswer) 
           {
               echo "<br>";
               //echo "BEGIN FOR LOOP TEST";
               //echo "<br>";
               // if the student answer has the current question id, echo it
               // otherwise, ignore it
               $currentQuestionID = $question->id;
               $currentStudentAnswerQuestionID = $studentAnswer->question_id;
               if($question->id == $studentAnswer->question_id)
               {
                   echo "question ID matches!";
                   echo "<br>";
                   echo "current question ID is: $currentQuestionID";
                   echo " and it matches the student answer question id: $currentStudentAnswerQuestionID";
                   echo "<br>";
               }
               else
               {
                   echo "question ID did NOT match!";
                   echo "<br>";
                   echo "current question ID is: $currentQuestionID";
                   echo " and it DOES NOT MATCH the student answer question id: $currentStudentAnswerQuestionID";
                   echo "<br>";
               }
               //echo "END FOR LOOP TEST";
               //echo "<br>";
           }
           
           
           echo "<br>";

        }
        echo "<br>";
        echo "<br>";
        
        // compare each of the question's answers to student response
        
        
        
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

    // return $sc->questions()->get();
});

Route::get('/t/{id}', 'QuizController@generateQuestions');


Route::get('/score_test/{scorecardID}', 'ScoreCardController@gradeQuiz');

Route::get('/grade_test/{id}', 'ScoreCardController@grade');

Route::get('/{user}', function($user){
			return redirect('/');
});

Route::get('/view_scorecard/{id}', 'ScoreCardController@show');

// for now, view by score card ID
// eventually, change it so that you view an individual scorecard based on some id, probably user id
/*
Route::get('/view_scorecard/{id}', function($id) {
    $scoreCard = ScoreCard::find($id);
    // now, make it sexy
    // put a view in here instead and pass in $scoreCard
    
    $ID = $scoreCard->id;
    $QuizID = $scoreCard->quiz_id;
    $UserID = $scoreCard->user_id;
    $Score = $scoreCard->score;
    $Status = $scoreCard->is_taken;
    
    echo "The ID of this scorecard is: $ID"; echo "<br>";
    echo "The quiz ID is: $QuizID"; echo "<br>";
    echo "The user ID is: $UserID"; echo "<br>";
    echo "The score is: $Score"; echo "<br>";
    echo "The status is: $Status"; echo "<br>";
    
    echo $scoreCard;
});
*/


