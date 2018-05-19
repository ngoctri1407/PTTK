<?php
/**
 * Created by IntelliJ IDEA.
 * User: tripham
 * Date: 11/1/17
 * Time: 9:17 PM
 */

// front end

Route::get('/', 'HomeController@home');

Route::get('/resize-thumbnail', 'HomeController@resizeAllImages');

Route::get('/property/detail/{name}/{id}', ['uses' =>'PropertyController@propertyDetail']);

Route::get('/show-properties/{name}/{code}', ['uses' => 'PropertyController@showProperties']);

Route::get('/project/detail/{name}/{id}', ['uses' => 'ProjectController@projectDetail']);

Route::get('/show-projects/{name}/{code}', ['uses' => 'ProjectController@showProjects']);

Route::get('/show-projects/all', ['uses' => 'ProjectController@showAllProjects']);

Route::get('/search', 'SearchSaveController@search');

Route::get('/save', 'SearchSaveController@save');

Route::get('/news/detail/{name}/{id}', 'NewsController@newsDetail');

Route::get('/show-news/{category}', 'NewsController@showNews');

Route::get('/login', 'HomeController@login');

Route::post('/login', 'HomeController@login');

Route::get('/register', 'HomeController@register');

Route::post('/register', 'HomeController@register');

Route::get('/logout', 'HomeController@logout');

Route::post('/booking', 'PropertyController@createBooking');

// admin

Route::get('/admin/booking', 'Admin\AdminController@getListBooking');

Route::get('/admin', 'Admin\AdminController@index');

Route::post('/admin/', 'Admin\AdminController@login');

Route::get('/admin/dashboard', 'Admin\AdminController@dashboard');

Route::get('/admin/logout', 'Admin\AdminController@logout');

Route::get('/admin/inside','Admin\AmenitiesController@inside');

Route::post('/admin/inside/manage','Admin\AmenitiesController@manageinside');

Route::get('/admin/amenities/delete/{id}',['uses' =>'Admin\AmenitiesController@delete']);

Route::get('/admin/nearby','Admin\AmenitiesController@nearby');

Route::post('/admin/nearby/manage','Admin\AmenitiesController@managenearby');

Route::get('/admin/author','Admin\AuthorController@index');

Route::get('/admin/newauthor','Admin\AuthorController@newauthor');

Route::get('/admin/author/edit/{id}',['uses' => 'Admin\AuthorController@edit']);

Route::post('/admin/author/manage','Admin\AuthorController@manage');

Route::get('/admin/author/delete/{id}',['uses' =>'Admin\AuthorController@delete']);

Route::get('/admin/news','Admin\NewController@listnew');

Route::get('/admin/news/index','Admin\NewController@newposts');

Route::post('/admin/news/manage','Admin\NewController@manage');

Route::get('/admin/news/edit/{id}',['uses' =>'Admin\NewController@edit']);

Route::get('/admin/news/delete/{id}',['uses' =>'Admin\NewController@delete']);

Route::get('/admin/price','Admin\PriceController@index');

Route::post('/admin/price/manage','Admin\PriceController@manage');

Route::get('/admin/price/delete/{id}',['uses' =>'Admin\PriceController@delete']);

Route::get('/admin/furnished','Admin\FurnishedController@index');

Route::post('/admin/furnished/manage','Admin\FurnishedController@manage');

Route::get('/admin/furnished/delete/{id}',['uses' =>'Admin\FurnishedController@delete']);

Route::get('/admin/coderealestate','Admin\RealEstateController@index');

Route::post('/admin/realestate/manage','Admin\RealEstateController@manage');

Route::get('/admin/realestate/delete/{id}',['uses' =>'Admin\RealEstateController@delete']);

Route::get('/admin/realestate','Admin\DetailRealEstateController@getlistproperties');

Route::get('/admin/property/new','Admin\DetailRealEstateController@newproperty');

Route::post('/admin/realestate/manage',['uses'=>'Admin\DetailRealEstateController@manage']);

Route::post('/admin/realestate/rent/new/upload', ['uses'=>'Admin\DetailRealEstateController@upload']);

Route::post('/admin/realestate/edit/editupload', 'Admin\DetailRealEstateController@editupload');

Route::post('/admin/project/edit/editupload', 'Admin\ProjectController@editupload');

Route::post('/admin/realestate/edit/deleteimage', 'Admin\DetailRealEstateController@deleteimage');

Route::post('/admin/project/edit/deleteimage', 'Admin\ProjectController@deleteimage');

Route::get('/admin/realestate/edit/{id}',['uses' =>'Admin\DetailRealEstateController@edit']);

Route::get('/admin/property/delete/{id}',['uses' =>'Admin\DetailRealEstateController@delete']);

Route::get('/admin/project','Admin\ProjectController@index');

Route::get('/admin/project/new','Admin\ProjectController@newproject');

Route::post('/admin/project/new/upload','Admin\ProjectController@upload');

Route::post('/admin/project/manage','Admin\ProjectController@manage');

Route::get('/admin/project/edit/{id}',['uses' =>'Admin\ProjectController@edit']);

Route::get('/admin/project/delete/{id}',['uses' =>'Admin\ProjectController@delete']);

Route::post('/admin/hot/add','Admin\HotPropertiesController@add');

Route::post('/admin/hot/remove','Admin\HotPropertiesController@remove');

Route::post('/admin/realestate/search','Admin\DetailRealEstateController@search');

Route::post('/admin/property/select','Admin\DetailRealEstateController@select');

Route::post('/admin/realestate/edit/listimage','Admin\DetailRealEstateController@listimage');

Route::post('/admin/project/edit/listimage','Admin\ProjectController@listimage');

Route::post('/email', 'MailController@send');

Route::get('/admin/setting','Admin\SettingController@viewSetting');

Route::post('/admin/setting/manage','Admin\SettingController@manage');
