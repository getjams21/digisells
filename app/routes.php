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
// Route::get('/',function(){
// 	// $user=Auth::user();
// 	$user=Auth::user()->last_activity;
//   $date = Carbon::createFromTimestamp($user);
//   return $date->diffForHumans();
// });

Route::get('page', 'HomePageController');
Route::get('/register','UsersController@create');
Route::resource('users', 'UsersController');

#Subcategory select option ajax post
Route::post('/fetchSubCategory', 'AuctionController@fetchSubCategory');
#Registration
Route::get('/register','UsersController@create')->before('guest');
#Authentication
Route::get('login',['as' => 'login', 'uses' =>'SessionsController@create']);
Route::get('logout',['as'=>'logout', 'uses' =>'SessionsController@destroy']);
Route::resource('sessions', 'SessionsController',['only' => ['create','store','destroy']]);
#Image Upload
Route::resource('uploadImage', 'ImageUploadController');
#profiles
Route::get('/users/{username}', ['as' => 'profile', 'uses' => 'UsersController@show']);
// Route::get('/profile','UsersController@show');
#password reminders
Route::controller('password','RemindersController');
#registration validation posts
Route::post( '/searchUser', 'UsersController@searchPostUser' );
Route::post( '/searchEmail', 'UsersController@searchPostEmail' );
#direct change password patch
Route::patch( '/updateAccount', 'UsersController@updateAccount' );
#Selling Platform Option
Route::get('/selling', 'HomePageController@selling');
#Users dashboard routes set auth to login users
Route::group(["before" => "auth"], function() {

  
  #Auction Selling Platform
  Route::resource('/auction', 'AuctionController');
  Route::resource('/auction-listing', 'AuctionController');
  Route::get('sales-page/default', 'AuctionController@showAuctionDefault');
  #Direct Selling Platform
  Route::resource('/direct-selling', 'DirectSellingController');
  Route::resource('/sales-page-default', 'SalesPageController');
  #Dashboard pages
  Route::get('/dashboard','DashboardController@index');
  Route::get('/invoices','DashboardController@invoices');
  Route::get('/bids','DashboardController@bids');
  Route::get('/watchlist','DashboardController@watchlist');  
  Route::get('/listings','DashboardController@listings');  
  #Funds Controller
  Route::resource('funds', 'FundsController');
  Route::get('/addFunds','FundsController@create');
  #PAYMENT
  Route::resource('payment', 'PaymentController');
  Route::post('paypal', 'PaymentController@paypal');
  Route::get('execute', 'PaymentController@execute');
  Route::post('direct-selling/{step}', array('as' => 'direct-selling', 'uses' => 'DirectSellingController@listingSteps'));
  Route::resource('/product-selling', 'DirectSellingController');
  #Dashboard
  Route::resource('users.dashboard','DashboardController');
  Route::get('users/{username}/invoices','DashboardController@invoices');
  Route::get('users/{username}/bids','DashboardController@bids');
});



