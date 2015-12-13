<?php 

namespace App\Library;


/**
* 
*/
class MyTimer extends \Thread{
	public $myT; 
	public function __construct() {
            
    }

    public function run() {
        $myT = new PHP_Timer();
    }

    public function getTime()
    {
        echo "hello";
    }

}