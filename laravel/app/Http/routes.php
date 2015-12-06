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

/*
|--------------------------------------------------------------------------
| TODO -- DELETE BEFORE DEPLOYMENT
|--------------------------------------------------------------------------
|   1. Create Quiz Resource
|   2. 
|
|
|
|
|
|
|
*/



//[OK]
Route::get('/', function () {
    return view('landing');
});

//Dashboard [OK]
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

/* Student Route */
//[CHECK THIS]
Route::get('/all_students', 'StudentController@index');

Route::get('/instructions/{scorecardID}', function($scorecardID){ 
    Session::put('scorecardID', $scorecardID); 
    return view('scorecard.take'); 
});

Route::post('/quiz_agree', 'ScoreCardController@take_quiz');

/* Student Lecture */
/* Student Chair */



//[CHECK THIS]
Route::get('/classes', 'CourseController@index');

//[CHECK THIS]
Route::get('/users', [ 'middleware' => 'auth', 'uses' => 'UserController@index' ]);

//[CHECK THIS]
Route::get('/questions', [ 'middleware' => 'auth', 'uses' =>  'QuestionController@index' ]);

//[CHECK THIS]
Route::get('/questions/{id}', [ 'middleware' => 'auth', 'uses' =>  'QuestionController@show' ]);

//[MODIFY THIS]
Route::get('/take_quiz/{score_card_id}', 'ScoreCardController@take_quiz');

//[MODIFY THIS]
Route::post('/take_quiz', 'ScoreCardController@store');

//[MODIFY THIS]
Route::get('/finished_quiz', function (Request $request)
{
    return redirect('/t/wherepivot');
});

//[MODIFY THIS]
Route::get('/student/{student_id}/scores', 'StudentController@scores');

//[MODIFY THIS ROUTE NAME]
Route::get('/create_quiz', 'QuizController@create');

//[MODIFY THIS ROUTE NAME]
Route::post('/save_quiz', 'QuizController@store');

//[MAKE RESTFUL]
Route::post('/save_question', 'QuestionController@store');

//[CHECK ROUTES]
Route::resource('student', 'StudentController');

//[CHECK ROUTES]
Route::resource('quiz', 'QuizController');


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

Route::get('/scorecard/questions/{scorecardID}', function ($scorecardID)
{
    //Get ScoreCard
    $sc = ScoreCard::find($scorecardID);

    //Get questions
    $questions  = $sc->questions()->get();

    foreach ($questions as $question) {
        echo $question;
        
        foreach(Question::find($question->id)->answers as $a){
             echo "<br>";
            echo $a->pivot->id;
            echo "<br>";

        }
        echo "<br>";
        echo "<br>";
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

//[DELETE/REPLACE THIS]
Route::get('/t/{id}', 'QuizController@generateQuestions');

//[OK]
Route::get('/{user}', function($user){
    return redirect('/');
});

Route::get('/view_users', function() {
    $users = User::all();
    return view('user.view', ['users' => $users]);
});


//[DELETE THIS]
Route::get('/create_question', [ 'middleware' => 'auth', 'uses' => 'QuestionController@create']);

//[DELETE THIS]
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

//[DELETE THIS]
Route::get('/t', function ()
{
    return User::find(1)->scoreCards()->get();
});

//[DELETE THIS]
Route::get('/t/wherepivot', "ScoreCardController@grade_quiz");

//[DELETE THIS]
Route::get('/t/wherepivo', function ()
{
    $sc = ScoreCard::find(1);
    echo "==============================================";
    foreach ($sc->questions()->get() as $q) {
        echo "<br>Question ".$q->id;
        $correct_answers = $q->answers()->select('answer_question.id')->wherePivot('is_correct', '=', 1)->get();
        $student_answers = $sc->answer_questions()->select('answer_question_id')->wherePivot('question_id', '=', $q->id)->get();
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
});

//[DELETE THIS]
Route::get('/t/quiz/gen_question', function ()
{
    return Quiz::find(2)->generateQuestions()->count();  
});


//[DELETE THIS]
Route::get('/t/quiz/scorecard', function ()
{
    $sc = ScoreCard::find(2);
    if($sc->questions()->count() > 0){
        echo "<br>Current: ".$sc->load_questions()->id;
    }else{
        echo "<br>Current: ".$sc->generate_questions()->id;
    }
    $test = $sc->next();
    while($test != null){
        echo "<br>Next: ".$test->id;
        $test = $sc->next();
    }
});

