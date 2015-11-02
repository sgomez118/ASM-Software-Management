<?php

use App\Question;
use App\Course;
use App\User;
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

use App\Http\Controllers\AuthenticationController;

use App\Http\Middleware\Authenticate;


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
				return view('user.chairs.dashboard', ['courses' => Course::all()]);
			default:
				return redirect('/');
			}
	}else{
		return redirect('/');
	}
});

Route::get('/create_quiz', 'QuizController@create');
Route::post('/save_quiz', 'QuizController@store');

Route::get('/classes', 'CourseController@index');

Route::get('/users', [ 'middleware' => 'auth', 'uses' => 'UserController@index' ]);

Route::get('/questions', [ 'middleware' => 'auth', 'uses' =>  'QuestionController@index' ]);

Route::get('/questions/{id}', [ 'middleware' => 'auth', 'uses' =>  'QuestionController@show' ]);


Route::get('/student/{student_id}/scores', 'StudentController@scores');

Route::get('/create_question', [ 'middleware' => 'auth', 'uses' => 'QuestionController@create']);

Route::post('/save_q', 'QuestionController@store');

Route::resource('student', 'StudentController');
Route::resource('quiz', 'QuizController');

Route::get('/test', function (){
	// return User::getCourses(8);
	//select question_id from questions ordered->random, limit->3
	// return Question::select('id')->orderByRaw("RAND()")->take(3)->get();
	echo "string";
	return Course::find(3)->quizzes()->get();
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

Route::get('/view_quizzes', function () {
	$questions = Question::all();
    return view('quiz.view', ['questions' => $questions ]);
});

Route::get('/view_users', function() {
    $users = User::all();
    return view('user.view', ['users' => $users]);
});

Route::get('/{user}', function($user){
			return redirect('/');
});



