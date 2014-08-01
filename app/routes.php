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
<<<<<<< HEAD
Route::get('/',['as'=>'home','uses'=>'HomePageController@index']);
Route::resource('page', 'HomePageController');
Route::get('/register','UsersController@create');
Route::resource('users', 'UsersController');
Route::resource('/selling', 'SellingController');
Route::resource('/auction', 'AuctionController');
=======
#Home
Route::get('/',['as'=>'home','uses'=>'PageController@index']);
Route::resource('page', 'PageController');

#Registration
Route::get('/register','UsersController@create')->before('guest');
Route::resource('users', 'UsersController');

#Authentication
Route::get('login',['as' => 'login', 'uses' =>'SessionsController@create']);
Route::get('logout',['as'=>'logout', 'uses' =>'SessionsController@destroy']);
Route::resource('sessions', 'SessionsController',['only' => ['create','store','destroy']]);
>>>>>>> e0b563bee62efe696626d51e1b9acc0abbd53dd5
