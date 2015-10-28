<?php

namespace App\Http\Controllers; // if you exclude this but include the line below, you get a "reflection exception"

use Illuminate\Routing\Controller as BaseController; // if you remove this line, then it can't find BaseController: http://stackoverflow.com/questions/29036830/base-controller-not-found-laravel-php

use Illuminate\Support\Facades\URL; // if you exclude this, server doesn't know where the URL class is, so it will complain about URL::route(); I found it by going to the laravel folder and searching for URL to see where the class was located

/** Controller that handles the "about" page */ 
class AboutController extends BaseController {

    // must be public so that Laravel can get to them 
    // can be private if they don't impact the route (some calculation stuff)
    public function showAbout()
    {
        return 'ABOUT content accessed via AboutController';
    }
    
    public function showSubject($theSubject)
    {
        return "Content related to $theSubject accessed via AboutController"; // need to use double quotes to access $theSubject
    }
    
    public function showDirections()
    {
        $theURL = URL::route('directions'); // go the route labeled 'directions'
        return "Directions go to this URL: $theURL";
    }
    
    
}


?>


