<?php

class AuctionController extends \BaseController {

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
  						$copyTime = substr($originDateTime, -8);
						$copyDate = substr($originDateTime, 0, -8);
						  	//convert date
						  	$copyYear = substr($copyDate, -4);
						  	$cutYear = substr($copyDate, 0, -5);
						  	$convertedDate = $copyYear.'-'.$cutYear;
						  	$convertedDate = date('Y-m-d', strtotime($convertedDate));
						  	$newDateTime = $convertedDate.$copyTime;
  					$auction->endDate = $newDateTime;
  					$auction->incrementation = Input::get('incrementation');
  					$auction->affiliatePercentage = Input::get('affiliatePercentage');
  					$auction->save();

  					//save default bid amount
  					$bidding->auctionID = $auction->id;
  					$bidding->userID = Auth::user()->id;
  					$bidding->amount = $auction->minimumPrice;
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


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		// select auction.*, product.* from auction as auction 
		// 	inner join product as product on auction.productID=product.id 
		// 	where auction.sold=0 and auction.endDate != NOW() 
		// 	order by auction.created_at desc limit 4
		//fetch auction event
		$auctionEvent = DB::select('
			select a.*,p.imageURL,p.productDescription,p.userID,w.status as watched 
			from auction as a inner join product as p on a.productID = p.id 
			left join (select * from watchlist where watcherID='.Auth::user()->id.') as w 
			on a.productID=w.productID where a.id ='.$id
		);
		return View::make('pages.auction.show',compact('auctionEvent'));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
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
  			$subCategories = DB::table('Subcategory')->where('categoryID', $val)->lists('name','id');
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
		$listings = DB::select('
			select a.id,a.buyoutPrice, a.auctionName,a.productID,p.userID, p.imageURL,p.productDescription,
			(SELECT MAX(b.amount) as amount from bidding as b where b.auctionID = a.id) as minimumPrice , w.status as watched from auction as a 
			inner join product as p on a.productID=p.id left join (select * from watchlist where watcherID='.Auth::user()->id.') as w on a.productID=w.productID 
			where a.sold=0 and a.endDate != NOW() 
			order by a.created_at desc limit 4
		');
		// dd($listings);
		$lastItem = end($listings);
		$lastID = $lastItem->id;
		Session::put('lastID', $lastID);
		return View::make('pages.auction.auction-listings',compact('listings'));
	}
	public function loadMoreAuction(){
		if(Request::ajax()){
			$lastID = Session::get('lastID');
			$listings = DB::select('
				select a.id,a.buyoutPrice, a.auctionName,a.productID,p.userID, p.imageURL,p.productDescription,
			(SELECT MAX(b.amount) as amount from bidding as b where b.auctionID = a.id) as minimumPrice , w.status as watched from auction as a 
			inner join product as p on a.productID=p.id left join (select * from watchlist where watcherID='.Auth::user()->id.') as w on a.productID=w.productID 
				where a.sold=0 and a.endDate != NOW() and a.id < '.$lastID.'
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
  				select id, auctionName, 
  				(SELECT MAX(b.amount) as amount from bidding as b where b.auctionID = '.$val.') as minimumPrice 
  				from auction where id = '.$val.'
  				');
			return Response::json($auctionEvent);
  		}
	}
}
