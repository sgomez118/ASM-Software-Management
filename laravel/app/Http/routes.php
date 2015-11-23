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

    $studentAnswers  = $sc->answer_questions()->get();
   // echo $sc->questions()->get();
    foreach ($studentAnswers as $answer) {
        //echo $answer;
        $qID = $answer->question_id;
        $question = Question::find($qID);

        switch ($question->type) {
            case 'single-choice':
                # code...
                break;
            
            case 'multi-value':
                foreach ($question->answers as $answer) {
                    //is answer in student_answers?

                }
                break;
            
            case 'free-response':
                # code...
                break;
            
            default:
                # code...
                break;
        }

        # code...
    }

    return $sc->questions()->get();
});

Route::get('/t/{id}', 'QuizController@generateQuestions');


Route::get('/{user}', function($user){
			return redirect('/');
});
