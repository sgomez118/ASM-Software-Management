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

Route::get('/', array('before' => 'newyear', 'uses' => 'HomeController@showWelcome'));
Route::get('about', 'AboutController@showAbout');
Route::get('about/{theSubject}', 'AboutController@showSubject');
Route::get('about/directions', array('uses' => 'AboutController@showDirections','as' => 'directions'));

/*
Route::get('/', array(
    'before' => 'newyear'|'valentines'|'halloween'|'birthdate:10/20',
    'after' => 'logvisits',
    function()
{
	return View::make('hello');
}));

Route::get('about', function()
{
    return 'ABOUT content';
});

Route::get('about/directions', array('as' => 'directions', function()
{
    $theUrl = URL::route('directions');
    return "DIRECTIONS go on this URL: $theUrl";
}));
*/

Route::any('submit-form', function()
{
    return 'Process FORM';
});

/*
Route::get('about/{theSubject}', function($theSubject)
{
    return $theSubject.' content';
});
*/
Route::get('about/classes/{theSubject}', function($theSubject)
{
    return "Content on $theSubject";
});

Route::get('about/classes/{theArt}/{theSpecialty}', function($theArt, $theSpecialty)
{
    return "Welcome to $theSpecialty in $theArt!";
});

Route::get('where', function()
{
    return Redirect::route('directions');
});

Route::get('vote', array(
    'before' => 'age:15',
    function()
{
    return 'Vote!';
}));

Route::get('programs', function()
{
   return View::make('programs');
});

Route::post('thanks',function()
{
    $theEmail = Input::get('email');
    return View::make('thanks')->with('theEmail', $theEmail);
});
