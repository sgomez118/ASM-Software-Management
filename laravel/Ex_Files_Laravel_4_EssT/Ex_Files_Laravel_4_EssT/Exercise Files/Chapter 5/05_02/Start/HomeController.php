<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showWelcome()
	{

       /*
        Schema::create('art', function($newtable)
        {
            $newtable->increments('id');
            $newtable->string('artist');
            $newtable->string('title',500);
            $newtable->text('description');
            $newtable->date('created');
            $newtable->date('exhibition_date');
            $newtable->timestamps();
        });
       */

        /*
        Schema::table('art', function($newcolumn) {
            $newcolumn->boolean('alumni');
            $newcolumn->dropColumn('exhibition_date');
        });
        */

        /*
        Schema::dropIfExists('art');
        */

        /*
        Schema::create('sculpture', function($newtable)
        {
            $newtable->increments('id');
            $newtable->string('artist');
            $newtable->string('title',500);
            $newtable->date('created');
            $newtable->timestamps();
        });

        Schema::table('sculpture', function($newcolumn) {
            $newcolumn->text('description');
        });
        */

        /*
		Schema::dropIfExists('sculpture');
		*/

        $theLandmarks = array("St. Marks","Brooklyn Heights","Central Park","Times Square");
        return View::make('hello', array('theLocation' => 'NYC', 'theWeather'=> 'stormy', 'theLandmarks' => $theLandmarks ));
	}

}
