<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{

    $painting = Painting::find(1);
    $painting->title = 'Do No Wrong - Just Do Right';
    $painting->save();
    return $painting->title; 
 
 /*
    $painting = new Painting;
    $painting->title = 'Do No Wrong';
    $painting->artist = 'D. DoRight';
    $painting->date = 2014;
    $painting->save();
    
	return View::make('hello');
  */
});

Route::get('about', function() {
    return 'About content goes here';
});
Route::get('about/directions', function() {
    return 'Directions go here';
});
Route::get('about/{theSubject}', function($theSubject) {
    return $theSubject.' content goes here';
});
Route::get('/about/classes/{theSubject}', function($theSubject)
{
    return "Content about the {$theSubject} classes goes here.";
});