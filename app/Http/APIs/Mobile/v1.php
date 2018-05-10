<?php
/**
 * Created by IntelliJ IDEA.
 * User: tripham
 * Date: 11/1/17
 * Time: 9:19 PM
 */

/**
 * MOBILE APIs
 */
// Version 1
$controllerPrefix = 'Mobile\V1\\';
$apiPrefix = '/api/mobile/v1';

$apis = [
  'post' => [
    // BOOKING
    '/booking/create' => 'ApiBookingController@createBooking',
    '/booking/confirm' => 'ApiBookingController@getSavedList',
    '/booking/login' => 'ApiBookingController@loginBooking',
    '/booking/logout' => 'ApiBookingController@logoutBooking',

    
  ],
  'get' => [
    // PROPERTIES
    '/properties/list' => 'ApiPropertyController@getPropertyList',
    '/property' => 'ApiPropertyController@getPropertyDetail',
    '/property/next' => 'ApiPropertyController@getNextItem',
    // SAVED PROPERTIES
    '/properties/saved' => 'ApiPropertyController@getSavedList',
    // RANDOM PROPERTIES
    '/properties/random' => 'ApiPropertyController@getRandomList',


    // PROJECTS'
    '/projects/list' => 'ApiProjectController@getProjectList',
    '/project' => 'ApiProjectController@getProjectDetail',
    '/project/next' => 'ApiProjectController@getNextItem',

    // NEWS'
    '/news/list' => 'ApiNewsController@getNewsList',
    '/news' => 'ApiNewsController@getNewsDetail',
    '/news/next' => 'ApiNewsController@getNextItem',
    
    // ABOUT
    '/about' => 'ApiAboutController@getAbout',

    // SEARCH
    '/search' => 'ApiSearchController@search',
    
    // BOOKING
    '/booking/list' => 'ApiBookingController@getListBooking',


  ]
];

foreach ($apis as $method=>$api) {
  foreach ($api as $url=>$controller) {
    Route::{$method}("{$apiPrefix}{$url}", "{$controllerPrefix}{$controller}");
  }
}
