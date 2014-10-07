<?php
use PayPal\Types\AP\PayRequest;
use PayPal\Types\AP\Receiver;
use PayPal\Types\AP\ReceiverList;
use PayPal\Types\Common\RequestEnvelope;
use PayPal\Service\AdaptivePaymentsService;
use PayPal\Types\AP\PaymentDetailsRequest;
use Carbon\Carbon;
class AuctionController extends \BaseController {
	private $_apiContext;
	private $paypal;
    private $_ClientId='AaexIxC3q4yf1Fj65Mg0e7fxjCSYjBw0rUwRuiXuBxwIan0Biqb1QtHbFav-';
    private $_ClientSecret='EBDU3RAmr8mtH9J-KP027YM2rLbUN_vKOtWFMVvIBwpEvFWBV0T2pCIwQ91b';
	function __construct()
	{	
		
		$this->_apiContext = Paypalpayment::ApiContext(
            Paypalpayment::OAuthTokenCredential(
                $this->_ClientId,
                $this->_ClientSecret
            )
        );
        $this->beforeFilter('auth',['only' => ['index','store','testBidding','showDirectSellingListings',
			'placingBid','validateReservedFunds']]);
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$category = Category::lists('categoryName','id');
		$subCategories = DB::table('Subcategory')->where('categoryID', 1)->lists('name','id');
		return View::make('pages.auction', compact('category','subCategories'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{	
		$subcategory = new Subcategory;
		$product = new Product;
		$auction = new Auction;
		$copyright = new Copyright;
		$bidding = new Bidding;
		$imageFile = Input::file('fileUpload');
		$copyrightFile = Input::file('copyrightFileUpload');

  			if (Input::hasFile('fileUpload') && Input::hasFile('copyrightFileUpload')){
  				//saving product info
  				if(Input::hasFile('productUpload') || Input::has('DownloadLink')){
  					$product->subcategoryID = Input::get('SubCategory');
					$product->userID = Auth::user()->id;
					$product->productName = Input::get('ProductName');
					$product->productDescription = Input::get('ProducteDescription');
					$product->quantity = Input::get('Qty');
					if(Input::hasFile('productUpload')){
						$productFile = Input::file('productUpload');
						$productFileName = time().'-'.$productFile->getClientOriginaLName();
						//saving file to directory
						$productFile = $productFile->move(public_path().'/product/items/', $productFileName);
						
						$product->downloadLink = $productFileName;
					}else{
						$product->downloadLink = Input::get('DownloadLink');
					}

					$imageFileName = time().'-'.$imageFile->getClientOriginaLName();
					//save file to directory
					$imageFile = $imageFile->move(public_path().'/product/images/', $imageFileName);
					
					$product->imageURL = $imageFileName;
					//saving product info to database
					$product->save();
					
					$copyright->productID = $product->id;

					$copyrightFileName = time().'-'.$copyrightFile->getClientOriginaLName();
					//save file to directory
					$copyrightFile = $copyrightFile->move(public_path().'/product/copyrights/', $copyrightFileName);
					$copyright->supportingFiles = $copyrightFileName;
					//save copyright to db
					$copyright->save();
  					
  					//saving auction event
  					$auction->auctionName = Input::get('auctionName');
  					$auction->productID = $product->id;
  					$auction->minimumPrice = Input::get('minimumPrice');
  					$auction->buyoutPrice = Input::get('buyoutPrice');
  					$date = Input::get('startDate');
  					$convDate = strtotime($date);
  					//convert date to datetime of StartDate
  						$originDate = Input::get('startDate');
  						$copyYear = substr($originDate, -4);
  						$cutYear = substr($originDate, 0, -5);
  						$convertedDate = $copyYear.'-'.$cutYear;
  					$auction->startDate = date('Y-m-d', strtotime($convertedDate));
  					////convert date to datetime of endDate
  						$originDateTime = Input::get('endDate');
  						$copyTime = date('H:i:s'); $copyDate = substr($originDateTime, 0, 10);
					  	//convert date
					  	$copyYear = substr($copyDate, -4);
					  	$cutYear = substr($copyDate, 0, -5);
					  	$convertedDate = $copyYear.'-'.$cutYear;
					  	$convertedDate = date('Y-m-d', strtotime($convertedDate));
					  	$newDateTime = $convertedDate.' '.$copyTime;
  					$auction->endDate = $newDateTime;
  					$auction->incrementation = Input::get('incrementation');
  					$auction->affiliatePercentage = Input::get('affiliatePercentage');
  					$auction->save();

  					//save default bid amount
  					$bidding->auctionID = $auction->id;
  					$bidding->amount = $auction->minimumPrice;
  					$bidding->userID = Auth::user()->id;
  					$bidding->highestBidder = 0;
  					$bidding->maxBid = 0.0000;
  					$bidding->save();
  					
  					$watchers = DB::select("select watcherID,productID from watchlist where userID=".Auth::user()->id." and status=1 ");
					foreach($watchers as $watcher)
					{
						if(!$watcher->productID){
  						$id = $watcher->watcherID;
  						$thisproduct = Auction::find($auction->id);
			  			$addProduct = User::find($id);
						$addProduct->newNotification()
						    ->withType('AddProduct')
						    ->withSubject(Auth::user()->username)
						    ->withBody("has Added a new Auction event <a href='auction-listing/".$auction->id."'> <b>".$auction->auctionName." </b> </a>")
						    ->regarding($thisproduct)
						    ->deliver();
						}    
			  		}
  					//Save id's on Session for default sales page
  					Session::put('productID', $product->id);
  					Session::put('auctionID', $auction->id);
  					}
  				
  			}
	}
	public function testBidding(){
		$originDateTime = '09-16-2014 12:1:1';
		$length = strlen($originDateTime);
		// $carbonDate = Carbon::now()->timestamp;
		// $copyTime = substr($originDateTime, 11);	
		$copyTime = date('H:i:s');
		$copyDate = substr($originDateTime, 0, 10);
	 // //  	//convert date
	  	$copyYear = substr($copyDate, -4);
	  	$cutYear = substr($copyDate, 0, -5);
	  	$convertedDate = $copyYear.'-'.$cutYear;
	  	$convertedDate = date('Y-m-d', strtotime($convertedDate));
	  	$newDateTime = $convertedDate.' '.$copyTime;
	  	dd($newDateTime);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{	
		if(Auth::user()){
			$w = ',w.status as watched';
			$query='left join (select * from watchlist where watcherID='.Auth::user()->id.') as w on a.productID=w.productID ';
		}else{
			$w=',0 as watched ';
			$query = ' ';
		}
		$auctionEvent = DB::select('
			select a.*,
			(SELECT COUNT(id) from bidding where auctionID = '.$id.' and amount != 0) as bidders,
			(SELECT MAX(b.amount) as amount from bidding as b where b.auctionID = '.$id.') as amount,
			(Select userID from bidding where auctionID = '.$id.' order by amount desc limit 1) as highestBidder,
			p.imageURL,p.productDescription,p.userID,p.details,
			(select stars from reviews where productID = a.productID) as stars '.$w.'
			from auction as a inner join product as p on a.productID = p.id 
			'.$query.' where a.id ='.$id.''
		);
		return View::make('pages.auction.show',compact('auctionEvent','incValue'));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		if(Request::ajax()){
			$auction = Auction::find($id);
			// $auction->sold = 1;
			// $auction->save();

			//identify the seller
			$product = Product::find($auction->productID);

			$creditsUsed = 0.00;
			$affiliateCommission = 0.00;

			//check if has highest bidder
			$bidder = DB::select('select userID, MAX(amount) as amount from bidding where auctionID='.$id.' and userID != '.$product->userID.'');

			if($bidder[0]->amount != NULL){
				// echo '<pre>';
				// return dd($bidder);
				$winner = User::find($bidder[0]->userID);
				$sales = new Sales;
				$sales->amount = (float) $bidder[0]->amount;
				if($winner->fund < $sales->amount){
					$creditsAdd = DB::select('select SUM(creditAdded) as added from credits where userID='.$winner->id.'');
					$creditsDeduct = DB::select('select SUM(creditDeducted) as deducted from credits where userID='.$winner->id.'');
					$creditsTotal = (float) $creditsAdd[0]->added - (float) $creditsDeduct[0]->deducted;

					$fundPlusCredits = $creditsTotal + (float) $winner->fund;
					if($fundPlusCredits < $sales->amount){
						return Redirect::back()->withFlashMessage('
							<center><div class="alert alert-danger square error-bid" role="alert">
								<b>Ohh Snap!..Insufficient Fund!</b><br>
								<a href="/payment/create" <button class="btn btn-success" id="addFund">Add Funds</button></a>
							</div></center>
						');
					}
					else{
						$creditsUsed = (float)$sales->amount - (float)Auth::user()->fund;
					}
				}
				$sales->auctionID = $auction->id;
				$sales->buyerID = $winner->id;
				$sales->transactionNO = time();

				//add commission to affiliate if affiliated
				$refferedBy = DB::select('select referredBy from bidding where auctionID = '.$id.' and referredBy != NULL');
				if($refferedBy != NULL){
					$affiliateCommission = (float) $sales->amount * ((float) $auction->affiliatePercentage/100);
					$affiliateID = DB::select('select id from affiliates where userID = '.$refferedBy[0]->refferedBy.' 
									and auctionID = '.Input::get('auctionID').'');
					// echo '<pre>';
					// return dd($affiliateID);
					if($affiliateID){
						$affiliate = Affiliate::find($affiliateID[0]->id);
						$affiliate->amount = $affiliateCommission;
						$affiliate->save();

						//update sales record
						$sales->affiliateID = $affiliate->id;

						//add commission to affiliate fund
						$affiliateUser = User::find($affiliate->userID);
						$affiliateUser->fund += $affiliateCommission;
						$affiliateUser->save();
						// echo '<pre>';
						// return dd($affiliateUser->fund);
					}
				}
				//save sales
				$sales->save();

				//deduct amount to current fund of buyer
				$buyer = User::find($winner->id);
				if($creditsUsed != 0.00){
					$buyer->fund = 0.00;
				}else{
					$buyer->fund -= (float) $sales->amount;
				}
				$buyer->save();

				//add credits to buyer
				$credits = new Credits;
				$credits->userID = $winner->id;
				$credits->salesID = $sales->id;
				$credits->creditAdded = ((float) $sales->amount * 0.01);
				if($creditsUsed){
					$credits->creditDeducted = $creditsUsed;
				}
				$credits->save();

				//total credits
				$creditsAdded = DB::select('select SUM(creditAdded) as added from credits where userID='.$winner->id.'');
				$creditsDeducted = DB::select('select SUM(creditDeducted) as deducted from credits where userID='.$winner->id.'');
				$totalCredits = (float) $creditsAdded[0]->added - (float) $creditsDeducted[0]->deducted;

				//deduct company commission
				$companyCommission = ((float) $sales->amount * 0.09);

				//add funds to the seller
				$totalAmount = (((float) $sales->amount - $companyCommission) - (float) $credits->creditAdded) - $affiliateCommission;
				// echo '<pre>';
				// return dd($totalAmount);
				$seller = User::find($product->userID);
				$seller->fund += $totalAmount;
				// echo '<pre>';
				// return dd($seller->fund);
				$seller->save();

				//set auction event as sold
				$auction->sold = 1;
				$auction->save();
			}
			// $auction->sold = 1;
			// $auction->save();
			return Response::json($auction->endDate);
		}
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		if(Input::get('end')){
			$auction = Auction::find($id);
			//check for the highest bidder
				$bidder = DB::select('select id, MAX(amount) as amount from bidding where auctionID='.$id.'');
				if($bidder[0]->id != NULL){
					$creditsUsed = 0.00;
					$affiliateCommission = 0.00;
					$auction = Auction::find($id);
					$amount = $bidder[0]->amount;
					if(Session::get('affiliate')){
						$affiliateCommission = (float) $amount * ((float) $auction->affiliatePercentage/100);
						$affiliate = DB::select('select id from affiliates where referralLink = '.Session::get('affiliate').' 
										and auctionID = '.$id.'');
					
						if($affiliate){
							$affiliateID=$affiliate[0]->id;
						}else{
							$affiliateID=null;
						}
					}else{
						$affiliateID=null;
						$affiliateCommission = null;
					}
					$auction->endDate = date('Y-m-d H:i:s');
					$auction->save();
					Session::put('pay',['sellingID'=> null,
										'auctionID'=> $id,
										'amount'=>$amount,
										'creditsUsed'=>$creditsUsed,
										'affiliateID' =>$affiliateID,
										'affCommision'=>$affiliateCommission,
										'buyerID'=>$bidder[0]->id
										]);
					return Redirect::to('/pay');
				}
			return Redirect::back()
				->withFlashMessage('
						<div class="alert alert-success square error-bid" role="alert">
							<b>'.$auction->auctionName.' auction is Ended!</b><br>
						</div>
					');
		}
		else if(Input::get('cancel')){
			$auction = Auction::find($id);
			$auction->endDate = date('Y-m-d H:i:s');
			$auction->save();
			return Redirect::back()
				->withFlashMessage('
						<div class="alert alert-success square error-bid" role="alert">
							<b>'.$auction->auctionName.' auction is Terminated!</b><br>
						</div>
					');
		}
		else if(Input::get('endDate')){
			$endDate = Input::get('endDate').' '.date('H:i:s');
			try {
				$convertedDate = date('Y-m-d H:i:s', strtotime($endDate));
			} catch (Exception $e) {
				return Redirect::back()
				->withFlashMessage('
						<div class="alert alert-danger square error-bid" role="alert">
							<b>Invalid Date Format!</b><br>
						</div>
					');
			}
			$auction = Auction::find($id);
			$auction->endDate = $convertedDate;
			$auction->save();
			return Redirect::back()
				->withFlashMessage('
						<div class="alert alert-success square error-bid" role="alert">
							<b>End Date is Successfully Updated!</b><br>
						</div>
					');
		}
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}
	public function fetchSubCategory(){
		if(Request::ajax()){
  			$input = Input::all();
  			$val = $input['val'];
  			$subCategories = DB::table('Subcategory')->where('categoryID', $val)->lists('name','id','status');
			return Response::json($subCategories);
  		}
	}
	public function showAuctionDefault(){
		if(Session::has('productID') && Session::has('auctionID')){
			$product = Product::find(Session::get('productID'));
			$auction = Auction::find(Session::get('auctionID'));
			$amountPay = $auction->buyoutPrice * .01;
			$payRequest = new PayRequest();
			$receiver = array();
			$receiver[0] = new Receiver();
			$receiver[0]->amount = $amountPay;
			$receiver[0]->email = "digisells@admin.com";
			// return dd($receiver);
			
			$receiverList = new ReceiverList($receiver);
			$payRequest->receiverList = $receiverList;

			$requestEnvelope = new RequestEnvelope("en_US");
			$payRequest->requestEnvelope = $requestEnvelope; 
			$payRequest->actionType = "PAY";
			$payRequest->cancelUrl = "http://digisells.com/auction?cancel=true";
			$payRequest->returnUrl = "http://digisells.com/payAuction?success=true";
			$payRequest->currencyCode = "USD";
			$payRequest->ipnNotificationUrl = "http://replaceIpnUrl.com";

			$sdkConfig = array(
				"mode" => "sandbox",
				"acct1.UserName" => "digisells_api1.admin.com",
				"acct1.Password" => "PFT5XFQ42YDDEJYM",
				"acct1.Signature" => "An5ns1Kso7MWUdW4ErQKJJJ4qi4-AfQR4MeCy8ViZ7PE4umi3Me1o3PU",
				"acct1.AppId" => "APP-80W284485P519543T"
			);
			$adaptivePaymentsService = new AdaptivePaymentsService($sdkConfig);
			$payResponse = $adaptivePaymentsService->Pay($payRequest); 
			Session::put('payKey', $payResponse->payKey);
			return Redirect::away('https://www.sandbox.paypal.com/webscr?cmd=_ap-payment&paykey='.$payResponse->payKey);
		}else{
			return Redirect::to('auction');
		}
	}
	public function payAuction(){
	$product = Product::find(Session::get('productID'));
	$auction = Auction::find(Session::get('auctionID'));
	$payKey = Session::get("payKey");
			$sdkConfig = array(
				"mode" => "sandbox",
				"acct1.UserName" => "digisells_api1.admin.com",
				"acct1.Password" => "PFT5XFQ42YDDEJYM",
				"acct1.Signature" => "An5ns1Kso7MWUdW4ErQKJJJ4qi4-AfQR4MeCy8ViZ7PE4umi3Me1o3PU",
				"acct1.AppId" => "APP-80W284485P519543T"
			);
		$requestEnvelope = new RequestEnvelope("en_US");
		$paymentDetailsRequest = new PaymentDetailsRequest($requestEnvelope);
		$paymentDetailsRequest->payKey = $payKey;
		$adaptivePaymentsService = new AdaptivePaymentsService($sdkConfig);
		try {
		$paymentDetailsResponse = $adaptivePaymentsService->PaymentDetails($paymentDetailsRequest);
		} catch (PayPal\Exception\PPConnectionException $ex) {
	         return Redirect::to('auction')->withFlashMessage('<center><div class="alert alert-danger square"><b>Request Timeout!</b> Please check your Internet Connections.</div></center>');
		}
		// echo '<pre>';
		// return dd($paymentDetailsResponse);
		if($paymentDetailsResponse->status=='COMPLETED'){
	    $auction->paid=1;
	    $auction->payKey = $payKey;
	    $auction->save();
		return View::make('pages.product.auction-page-default', compact('product','auction'));
		}else{
			return Redirect::to('auction')->withFlashMessage('<center><div class="alert alert-danger square"><b>Request Timeout!</b> Something went wrong.</div></center>');
		}
	    

	}
	public function showAuctionListings(){
		//check if there are bidders
		//If bidded, set minimum price to highest bidder
		//else, set minimum price to starting price
		if(Request::get('q')){
			$search=' and a.auctionName LIKE "%'.Request::get('q').'%" ';
		}else{$search = '';}
		if(Request::get('SubCategory')){
			$subcategory=' and p.subcategoryID ='.Request::get('SubCategory').'';
		}else{$subcategory = '';}
		if(Request::get('price')){
			if(Request::get('price') ==1){
				$x= '<=50';
			}elseif(Request::get('price') ==2){
				$x= ' between 50 and 100';
			}elseif(Request::get('price') ==3){
				$x= ' between 100 and 500';
			}elseif(Request::get('price') ==4){
				$x= ' between 500 and 1000';
			}elseif(Request::get('price') ==5){
				$x= '>=1000';
			}
			$price=' and (a.minimumPrice '.$x.' or a.buyoutPrice '.$x.')';
		}else{$price = '';}
		if(Auth::user()){
			$w = ',w.status as watched';
			$query='left join (select * from watchlist where watcherID='.Auth::user()->id.') as w on a.productID=w.productID ';
		}else{
			$w=',0 as watched ';
			$query = ' ';
		}
		$category = Category::lists('categoryName','id');
		$subCategories = DB::table('Subcategory')->where('categoryID', 1)->lists('name','id');
		$listings = DB::select('
			select a.id,a.buyoutPrice, a.auctionName,a.productID,a.endDate,a.affiliatePercentage,p.userID, p.imageURL,p.productDescription,
			(SELECT COUNT(id) from bidding where auctionID = a.id and amount != 0 and highestBidder = 1) as bidders,
			(SELECT MAX(b.amount) as amount from bidding as b where b.auctionID = a.id) as minimumPrice,
			(Select userID from bidding where auctionID = a.id order by amount desc limit 1) as highestBidder '.$w.' from auction as a 
			inner join product as p on a.productID=p.id '.$query.' 
			where a.sold=0 and a.endDate >= NOW() '.$search.''.$subcategory.''.$price.'
			order by a.created_at desc limit 10
		');
		if($listings){
			$lastItem = end($listings);
			$lastID = $lastItem->id;
			Session::put('lastID', $lastID);
		}
		$selected ='AU';
		return View::make('pages.auction.auction-listings',compact('listings','category','subCategories'));
		
	}
	public function loadMoreAuction(){
		if(Request::ajax()){
			$lastID = Session::get('lastID');
			$listings = DB::select('
			select a.id,a.buyoutPrice, a.auctionName,a.productID,p.userID, p.imageURL,p.productDescription,
			(SELECT COUNT(id) from bidding where auctionID = a.id and amount != 0 and highestBidder = 1) as bidders,
			(SELECT MAX(b.amount) as amount from bidding as b where b.auctionID = a.id) as minimumPrice,
			(Select userID from bidding where auctionID = a.id order by amount desc limit 1) as highestBidder,
			w.status as watched from auction as a 
			inner join product as p on a.productID=p.id left join (select * from watchlist where watcherID='.Auth::user()->id.') as w on a.productID=w.productID 
				where a.sold=0 and a.endDate >= NOW() and a.id < '.$lastID.'
				order by a.created_at desc limit 4
			');
			if($listings != NULL){
				$lastItem = end($listings);
				$lastID = $lastItem->id;
				Session::put('lastID', $lastID);
				return Response::json($listings);
			}
		}
	}
	public function placingBid($val){
		if(Request::ajax()){
  			$auctionEvent = DB::select('               
			select a.id, a.auctionName, a.incrementation,
				COUNT(b.id) as bidders, MAX(b.amount) as minimumPrice
			    from auction as a
			    inner join bidding as b on a.id=b.auctionID
			    where a.id = '.$val.'
  				');
			return Response::json($auctionEvent);
  		}
	}
	public function validateReservedFunds(){
		//select highest bids of user to a specified auction
		//indentify if the user's bid is the highest bid on a specified auction
		$id = Auth::user()->id;
		$reservedFund = 0;
		$biddings = DB::select('
			Select auctionID, MAX(amount) as amount from bidding where userID = '.$id.' Group by auctionID
		');
		foreach ($biddings as $bids) {
			$highestBidder = DB::select('Select userID from bidding where auctionID = '.$bids->auctionID.' order by amount desc limit 1');
			if ($highestBidder->userID == $id){
				$reservedFund = $reservedFund + $bids->amount;
			}
		}
		dd($reservedFund);
	}
	public function auctionResult(){
		//get id of the seller
		$seller = DB::select('
			select userID from product 
			inner join auction on auction.productID = product.id 
			where auction.id = '.Input::get('view-result').'
			');

		//get all bidding info for this auction
		$auctionResult = DB::select('
			select b.*, u.username, a.* from bidding as b
			inner join user as u on b.userID = u.id
			inner join auction as a on a.id = b.auctionID
			where b.auctionID = '.Input::get('view-result').'
			and b.userID != '.$seller[0]->userID.'
			');
		$summary = DB::select('
			select u.username, amount as maxAmount from bidding as b
			inner join user as u on b.userID = u.id
			where auctionID = '.Input::get('view-result').'
			and userID != '.$seller[0]->userID.'
			and amount = (select MAX(amount) from bidding where auctionID = '.Input::get('view-result').')
			');
		$bidders = DB::select('select COUNT(id) as bidders from bidding where auctionID = '.Input::get('view-result').'
			and userID != '.$seller[0]->userID.'');
		return View::make('pages.auction.auction-result', compact('auctionResult','summary','bidders'));
	}
}
