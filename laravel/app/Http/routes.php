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
	//$questions = Question::all();
    return view('welcome');
});

Route::get('/home', 'QuestionController@index');

Route::get('/classes', 'CourseController@index');

Route::get('/users', 'UserController@index');

Route::get('/questions', 'QuestionController@index');

Route::get('/questions/{id}', 'QuestionController@show');

Route::get('/create_question', function() {
    return view('question.create');
});

Route::post('/save_question', 'QuestionController@store');

Route::get('/auth/register', function() {
    return view('auth.register');
}); 

Route::post('/save_user', 'UserController@store');

// Authentication routes...
//Route::get('auth/login', 'Auth\AuthController@getLogin');
//Route::post('auth/login', 'Auth\AuthController@postLogin');
//Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
//Route::get('auth/register', 'Auth\AuthController@getRegister');
//Route::post('auth/register', 'Auth\AuthController@postRegister');
