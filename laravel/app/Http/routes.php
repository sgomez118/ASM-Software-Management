<?php

use App\Question;
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

use App\User;

use App\Quiz;

use App\Course;

Route::get('/', function () {
	$questions = Question::all();
    return view('welcome', ['questions' => $questions ]);
});

Route::get('/home', 'QuestionController@index');

Route::get('/classes', 'CourseController@index');

Route::get('/users', [ 'middleware' => 'auth', 'uses' => 'UserController@index' ]);

Route::get('/questions', [ 'middleware' => 'auth', 'uses' =>  'QuestionController@index' ]);

Route::get('/questions/{id}', [ 'middleware' => 'auth', 'uses' =>  'QuestionController@show' ]);

Route::get('/create_question', [ 'middleware' => 'auth', 'uses' => 'QuestionController@create']);

Route::post('/save_question', 'QuestionController@store');

// For the demo, might be the same as /view_quizzes
// Display a list of questions (this is currently handled by /view_quizzes
Route::get('/view_questions', function() {
    $questions = Question::all();
    return view('question.view', ['questions' => $questions ]);
});

Route::get('/view_quizzes', function () {
	$questions = Question::all();
    return view('quiz.view', ['questions' => $questions ]);
});

Route::get('/view_users', function() {
    $users = User::all();
    return view('user.view', ['users' => $users]);
});

// View the courses
Route::get('/view_courses', function() {
    $courses = Course::all();
    return view('course.view', ['courses' => $courses]);
});

// Create and insert a course into the database
Route::get('/create_course', 'CourseController@create');
Route::get('/save_course', 'CourseController@store');

// Create a quiz and insert into database
Route::get('/create_quiz', 'QuizController@create');
Route::post('/save_quiz', 'QuizController@store');

// Create a course and intert into database
Route::get('/create_course', 'CourseController@create');
Route::post('/save_course', 'CourseController@store');

/**
Route::get('/auth/register', function() {
    return view('auth.register');
}); 
*/

/**
Route::get('/auth/register', 'UserController@create');
Route::post('/save_user', 'UserController@store');
*/ 

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');





