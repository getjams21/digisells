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
#CSRF protection for all post request
Route::when('*', 'csrf', array('post'));
#Home
Route::get('/',['as'=>'home','uses'=>'HomePageController@index']);
// Route::get('/',function(){
//   return 'hello';
// });
Route::get('/facebookLogin', 'SessionsController@loginWithFacebook');
Route::get('/googleLogin', 'SessionsController@loginWithGoogle');
#Authentication
Route::get('login',['as' => 'login', 'uses' =>'SessionsController@create']);
Route::get('logout',['as'=>'logout', 'uses' =>'SessionsController@destroy']);
Route::resource('sessions', 'SessionsController',['only' => ['create','store','destroy']]);
#Registration
Route::get('/register','UsersController@create');
#registration validation posts
Route::post( '/searchUser', 'UsersController@searchPostUser' );
Route::post( '/searchEmail', 'UsersController@searchPostEmail' );
#Registration
Route::get('/register','UsersController@create')->before('guest');
#Home Page
Route::get('page', 'HomePageController');
#User resource (update,edit Secured)
Route::resource('users', 'UsersController');
#User profiles
Route::get('/users/{username}', ['as' => 'profile', 'uses' => 'UsersController@show']);
#Image Upload
Route::resource('uploadImage', 'ImageUploadController');
#password reminders
Route::controller('password','RemindersController');
#Product Detailing
Route::resource('edit-details', 'ProductController');
#Selling Platform Option
Route::get('/selling', 'HomePageController@selling');
#Marketplace Routes
Route::get('/auction-listings', 'AuctionController@showAuctionListings');
Route::get('/direct-selling-listings', 'DirectSellingController@showDirectSellingListings');
Route::post('/load-more-auction', 'AuctionController@loadMoreAuction');
Route::get('/placing-bid/{val}', ['as'=>'placing-bid', 'uses' =>'AuctionController@placingBid']);
#Auction Selling Platform
Route::resource('/auction', 'AuctionController');
Route::resource('/auction-listing', 'AuctionController');
Route::post('/auction-result', 'AuctionController@auctionResult');
#Direct Selling Platform
Route::resource('/direct-selling', 'DirectSellingController');
#AUTH FILTER ROUTES
Route::group(["before" => "auth"], function() {

  #Affiliation Process
  Route::resource('/promote', 'AffiliateController');
  Route::get('/selling-affiliate', 'AffiliateController@showAffiliatedProductForDirectSelling');
  Route::get('/auction-affiliate', 'AffiliateController@showAffiliatedProductForAuction');
  #User direct change password patch
  Route::patch( '/updateAccount', 'UsersController@updateAccount' );
  #Subcategory select option ajax post
  Route::post('/fetchSubCategory', 'AuctionController@fetchSubCategory');
  
  Route::get('sales-page/default', 'AuctionController@showAuctionDefault');
  Route::get('test-bidding', 'AuctionController@testBidding');
  #Bidding Process
  Route::resource('/place-bid', 'BiddingController');
  Route::get('/place-max-bid', 'BiddingController@placeMaxBid');
  Route::resource('/sales-page-default', 'SalesPageController');
  #Sales Processes
  Route::resource('/sales', 'SalesController');
  Route::get('/pay', 'SalesController@pay');
  Route::get('/sales-return', 'SalesController@returnPP');
  #Dashboard pages
  Route::get('/notifications','DashboardController@index');
  Route::get('/invoices','DashboardController@invoices');
  Route::get('/activebids','DashboardController@activebids');
  Route::get('/inactivebids','DashboardController@inactivebids');
  Route::get('/auctionList','DashboardController@auctionList'); 
  Route::get('/directSellingList','DashboardController@directSellingList'); 
  Route::get('/soldAuctions','DashboardController@soldAuctions'); 
  Route::get('/soldSelling','DashboardController@soldDirectSelling'); 
  Route::get('/affiliations','DashboardController@affiliations'); 
  Route::get('/credits','DashboardController@credits'); 
  Route::resource('/support','ComplaintController'); 
  Route::get('/solveRequest/{ticket}','ComplaintController@solveRequest');
  Route::post('/addComplaint/{ticket}','ComplaintController@addComplaint');

  // Route::get('/summary','DashboardController@summary'); 
  #NOTIFICATIONS
  Route::post( '/readNotif', 'DashboardController@readNotif' );
  #Funds Controller
  Route::get('/addFunds','FundsController@create');
  #PAYMENT
  Route::resource('payment', 'PaymentController');
  Route::post('paypal', 'PaymentController@paypal');
  Route::get('execute', 'PaymentController@execute');
  Route::resource('withdrawal', 'WithdrawalController');
  Route::post('direct-selling/{step}', array('as' => 'direct-selling', 'uses' => 'DirectSellingController@listingSteps'));
  Route::resource('/product-selling', 'DirectSellingController');
  #watchlist
  Route::post( '/watchProduct', 'WatchlistController@watchProduct' );
  Route::post( '/unwatchProduct', 'WatchlistController@unwatchProduct' );
  Route::post( '/watchUser', 'WatchlistController@watchUser' );
  Route::post( '/unwatchUser', 'WatchlistController@unwatchUser' );
  Route::get('/watchlist', ['as' => 'watchlist', 'uses' => 'WatchlistController@index']);
  // Route::resource('watchlist','WatchlistController');
  Route::get('/watchers', ['as' => 'watchers', 'uses' => 'WatchlistController@watchers']);
  Route::post( '/fetchSalesDetails', 'DashboardController@fetchSalesDetails' );

  #Reviews
  Route::resource('/product-review', 'ReviewsController');

});

Route::group(["before" => "role:admin"], function() {

   Route::get('/admin',['as' => 'admin', 'uses' =>'AdminController@index']);
   Route::get('/admin-auctions','AdminController@auctions');
   Route::get('/admin-selling','AdminController@selling');
   Route::get('/admin-bidding','AdminController@bidding');
   Route::get('/admin-auctionSales','AdminController@auctionSales');
   Route::get('/admin-sellingSales','AdminController@sellingSales');
   Route::get('/admin-affiliations','AdminController@affiliations');
   Route::get('/admin-credits','AdminController@credits');
   Route::get('/admin-sumary','AdminController@summary');
   Route::get('/admin-settings','AdminController@settings');
   Route::resource('/admin-dynamic-settings','AdminController');
   #Admin Users routes
   Route::get('/admin-users','AdminUserController@users');
   Route::get('/admin-users/{user}/edit','AdminUserController@edit');
   Route::post('/deactivateUser', 'AdminUserController@deactivateUser');
   Route::post('/activateUser', 'AdminUserController@activateUser');
   #Admin roles ajax routes
   Route::post('/getroles', 'AdminUserController@getroles');
   Route::post('/editroles', 'AdminUserController@editroles');
   #Admin Categories Routes
   Route::get('/admin-categories','AdminController@categories');
   Route::post('/getSubCategory', 'AdminController@fetchSubCategory');
   Route::post('/getdetails', 'AdminController@getdetails');
   Route::post('/editCategory', 'AdminController@editCategory');
   Route::post('/addCategory', 'AdminController@addCategory');
   #Admin Funds routes
   Route::get('/admin-deposits','AdminController@deposits');
   Route::get('/admin-withdrawals','AdminController@withdrawals');
   Route::get('/admin-deposits/{paymentID}','AdminController@showDeposit');
   Route::get('/admin-withdrawals/{payKey}','AdminController@showWithdrawal');
   Route::get('/admin-complaints','AdminController@complaints');
   Route::get('/admin-complaints/{ticket}','AdminController@editcomplaints');

});
Route::get( '/404', function(){
  return View::make('error.404');
});






