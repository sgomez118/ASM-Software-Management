<?php

use App\Question;
use App\Course;
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

// Authentication routes...
Route::get('/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

Route::get('/all_students', 'StudentController@index');

Route::get('/home', 'QuestionController@create');

Route::get('/classes', 'CourseController@index');


Route::get('/users', 'UserController@index');

Route::get('/questions', 'QuestionController@index');

Route::get('/questions/{id}', 'QuestionController@show');

Route::get('/student/{student_id}/scores', 'StudentController@scores');

Route::post('/save_q', 'QuestionController@store');

Route::resource('student', 'StudentController');
Route::resource('quiz', 'QuizController');

Route::get('/{user}', function($user){
	switch ($user) {
		case 'students':
		case 'professors':
			return view('user.'.$user.'.welcome');
		case 'chairs':
			return view('user.'.$user.'.welcome', ['courses' => Course::all()]);
		default:
			return redirect('/');
	}
});