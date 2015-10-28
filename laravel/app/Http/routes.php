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

Route::get('/', function () {
	$questions = Question::all();
    return view('welcome', ['questions' => $questions]);
});

Route::get('/classes', 'CourseController@index');

Route::get('/users', 'UserController@index');

Route::get('/questions', 'QuestionController@index');

Route::get('/questions/{id}', 'QuestionController@show');