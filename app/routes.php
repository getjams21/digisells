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
Route::get('/',['as'=>'home','uses'=>'HomePageController@index']);
Route::resource('page', 'HomePageController');
Route::get('/register','UsersController@create');
Route::resource('users', 'UsersController');
Route::resource('/selling', 'SellingController');
Route::resource('/auction', 'AuctionController');