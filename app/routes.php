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
#Image Upload
Route::resource('uploadImage', 'ImageUploadController');
#profiles
Route::get('/users/{username}', ['as' => 'profile', 'uses' => 'UsersController@show']);
Route::get('/profile','UsersController@show');
#password reminders
Route::controller('password','RemindersController');
#registration validation posts
Route::post( '/searchUser', 'UsersController@searchPostUser' );
Route::post( '/searchEmail', 'UsersController@searchPostEmail' );
#direct change password patch
Route::patch( '/updateAccount', 'UsersController@updateAccount' );
#Users dashboard routes set auth to login users
Route::group(["before" => "auth"], function() {

  Route::resource('users.dashboard','DashboardController');
  Route::get('users/{username}/invoices','DashboardController@invoices');
  Route::get('users/{username}/bids','DashboardController@bids');
});

