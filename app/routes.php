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

#Home
Route::get('/',['as'=>'home','uses'=>'HomePageController@index']);
Route::resource('page', 'HomePageController');
Route::get('/register','UsersController@create');
Route::resource('users', 'UsersController');

#Selling
Route::resource('/selling', 'SellingController');
Route::resource('/auction', 'AuctionController');

#Registration
Route::get('/register','UsersController@create')->before('guest');
Route::resource('users', 'UsersController');

#Authentication
Route::get('login',['as' => 'login', 'uses' =>'SessionsController@create']);
Route::get('logout',['as'=>'logout', 'uses' =>'SessionsController@destroy']);
Route::resource('sessions', 'SessionsController',['only' => ['create','store','destroy']]);

Route::get('/users/{username}', ['as' => 'profile', 'uses' => 'UsersController@show']);

