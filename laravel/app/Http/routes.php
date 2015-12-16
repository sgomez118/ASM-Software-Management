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



Route::get('/instructions/{scorecardID}', function($scorecardID){ 
    session(['scorecardID'=> $scorecardID]); 
    return view('scorecard._instructions'); 
});

Route::post('/quiz_agree', 'ScoreCardController@take_quiz');

/* Student Lecture */
/* Student Chair */



//[CHECK THIS]
Route::get('/classes', 'CourseController@index');

//[CHECK THIS]
Route::get('/users', [ 'middleware' => 'auth', 'uses' => 'UserController@index' ]);

//[MODIFY THIS]
Route::get('/take_quiz/{score_card_id}', 'ScoreCardController@take_quiz');

//[MODIFY THIS]
Route::post('/take_quiz', 'ScoreCardController@store');

//[MODIFY THIS]
Route::get('/finished_quiz', 'ScoreCardController@grade_quiz');

//[MODIFY THIS]
Route::get('/student/{student_id}/scores', 'StudentController@scores');


//[CHECK ROUTES]
Route::resource('student', 'StudentController');

//[CHECK ROUTES]
Route::resource('quiz', 'QuizController');

//[CHECK ROUTES]
Route::resource('question', 'QuestionController');

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




Route::get('/view_users', function() {
    $users = User::all();
    return view('user.view', ['users' => $users]);
});

Route::get('/create_free_response_question', 'QuestionController@create_free_response');
Route::post('/save_free_response_question', 'QuestionController@store_free_response');

Route::get('/create_true_false_question', 'QuestionController@create_true_false');
Route::post('/save_true_false_question', 'QuestionController@store_true_false');


Route::get('/test/answer_free_response/{question_id}', function($question_id)
{
    $question = Question::find($question_id);
    //echo $question;
    return view('scorecard.answer_free_response', ['question' => $question ]);
});

Route::post('/test/show_response', function($answer_question_id) {
    
    echo "Just testing to see if this link works!";
});


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



Route::get('/test/genQ', function ()
{
    return Quiz::find(2)->generate_questions();
});



//[OK]
Route::get('/{user}', function($user){
    return redirect('/');
});
