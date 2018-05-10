<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Request;
use Session;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

    function __construct(){
    	// check language request on URL and set language session
			if (Request::input('lang') != null) {
	      Session::put('lang', Request::input('lang'));
	    }

	    if (!Session::has('lang')) {
	      Session::put('lang', 'en');
	    }
	    // variable keep language session value
	    $appLang = "_".Session::get('lang');
	    define('appLang', $appLang);
    }
}
