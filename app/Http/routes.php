<?php

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

define('siteURL', env('APP_URL'));

/**
 * WEB APIs
 */
require_once("APIs/Web/web.php");

/**
 * MOBILE APIs
 */
require_once("APIs/Mobile/v1.php");
