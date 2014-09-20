<?php

use Carbon\Carbon;
class AuctionController extends \BaseController {
	function __construct()
	{
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
			p.imageURL,p.productDescription,p.userID '.$w.'
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

			$sales = new Sales;
			$sales->amount = $auction->buyoutPrice;
			if(Auth::user()->fund < $sales->amount){
				return Redirect::back()->withFlashMessage('
					<center><div class="alert alert-danger square error-bid" role="alert">
						<b>Ohh Snap!..Insufficient Fund!</b><br>
						<a href="/payment/create" <button class="btn btn-success" id="addFund">Add Funds</button></a>
					</div></center>
					');
			}
			$sales->auctionID = $auction->id;
			$sales->buyerID = Auth::user()->id;
			$sales->transactionNO = time();
			$sales->save();

			//deduct amount to current fund of buyer
			$buyer = User::find(Auth::user()->id);
			$buyer->fund -= (float) $sales->amount;
			$buyer->save();

			//add credits to buyer
			$credits = new Credits;
			$credits->userID = Auth::user()->id;
			$credits->salesID = $sales->id;
			$credits->creditAdded = ((float) $sales->amount * 0.01);
			$credits->save();

			//total credits
			$creditsAdded = DB::select('select SUM(creditAdded) as added from credits where userID='.Auth::user()->id.'');
			$creditsDeducted = DB::select('select SUM(creditDeducted) as deducted from credits where userID='.Auth::user()->id.'');
			$totalCredits = (float) $creditsAdded[0]->added - (float) $creditsDeducted[0]->deducted;

			//add commission to company
			$company = User::find(1);
			$company->fund += ((float) $sales->amount * 0.09);
			$company->save();

			//add commission to affiliate if affiliated

			//add funds to the seller
			$totalAmount = ((float) $sales->amount - (float) $company->fund) - (float) $credits->creditAdded;
			$product = Product::find($auction->productID);
			$seller = User::find($product->userID);
			$seller->fund += $totalAmount;
			$seller->save();

			//set auction event as sold
			$auction->sold = 1;
			$auction->save();
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
		//
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
			return View::make('pages.product.auction-page-default', compact('product','auction'));
		}else{
			return Redirect::to('auction');
		}
	}
	public function showAuctionListings(){
		//check if there are bidders
		//If bidded, set minimum price to highest bidder
		//else, set minimum price to starting price
		if(Auth::user()){
			$w = ',w.status as watched';
			$query='left join (select * from watchlist where watcherID='.Auth::user()->id.') as w on a.productID=w.productID ';
		}else{
			$w=',0 as watched ';
			$query = ' ';
		}
		$listings = DB::select('
			select a.id,a.buyoutPrice, a.auctionName,a.productID,a.endDate,p.userID, p.imageURL,p.productDescription,
			(SELECT COUNT(id) from bidding where auctionID = a.id and amount != 0 and highestBidder = 1) as bidders,
			(SELECT MAX(b.amount) as amount from bidding as b where b.auctionID = a.id) as minimumPrice,
			(Select userID from bidding where auctionID = a.id order by amount desc limit 1) as highestBidder '.$w.' from auction as a 
			inner join product as p on a.productID=p.id '.$query.'
			where a.sold=0 and a.endDate >= NOW()
			order by a.created_at desc limit 10
		');
		if($listings){
			$lastItem = end($listings);
			$lastID = $lastItem->id;
			Session::put('lastID', $lastID);
		}
		return View::make('pages.auction.auction-listings',compact('listings'));
		
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
}
