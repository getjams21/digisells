<?php

class DirectSellingController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$step = 'step-2';
		$category = Category::lists('categoryName','id');
		$subCategories = DB::table('Subcategory')->where('categoryID', 1)->lists('name','id');
		return View::make('pages.direct-selling', compact('category','subCategories','step'));
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
		$product = new Product;
		$subcacategory = new Subcategory;
		$selling = new Selling;
		$copyright = new Copyright;

		if(Input::hasFile('fileUpload')){
			if(Input::hasFile('productUpload') || Input::has('DownloadLink')){
				//get file inputs and save on paths
				$imageFile = Input::file('fileUpload');
				$imageFileName = time().'-'.$imageFile->getClientOriginaLName();
				//save file to directory
				$imageFile = $imageFile->move(public_path().'/product/images/', $imageFileName);

				//retrieve product info from sessions and save on db
				$product->subcategoryID = Session::get('subcategory');
				$product->userID = Auth::user()->id;
				$product->productName = Session::get('productName');
				$product->productDescription = Session::get('productDescription');
				$product->quantity = Session::get('quantity');
				$product->imageURL = $imageFileName;
				if(Input::hasFile('productUpload')){
					$productFile = Input::file('productUpload');
					$productFileName = time().'-'.$productFile->getClientOriginaLName();
					//saving file to directory
					$productFile = $productFile->move(public_path().'/product/items/', $productFileName);
					
					$product->downloadLink = $productFileName;
				}else{
					$product->downloadLink = Input::get('DownloadLink');
				}
				$product->save();
				//retrieve selling info from sessions and save on db
				$selling->sellingName = Session::get('sellingName');
				$selling->productID = $product->id;
				$selling->price = Session::get('price');
				$selling->discount = Session::get('discount');
				//set selling date and expiration date
					$sellingDate = date('Y/m/d h:i:s');
					$expirationDate = date('Y/m/d h:i:s', strtotime($sellingDate. ' + 30 days'));
				$selling->listingDate = $sellingDate;
				$selling->expirationDate = $expirationDate;
				$selling->affiliatePercentage = Session::get('affiliatePercentage');

				$selling->save();

				//Retrieve copyright info and save it on db
				
				if(Input::hasFile('copyrightFileUpload')){
					$copyright->productID = $product->id;
					$copyrightFile = Input::file('copyrightFileUpload');
					$copyrightFileName = time().'-'.$copyrightFile->getClientOriginaLName();
					//save file to directory
					$copyrightFile = $copyrightFile->move(public_path().'/product/copyrights/', $copyrightFileName);
					$copyright->supportingFiles = $copyrightFileName;
					$copyright->save();
				}

				//Saving necessary id's for future use in session
				Session::put('productID',$product->id);
				Session::put('sellingID',$selling->id);
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
		if(Auth::user()){
			$w = ',w.status as watched';
			$query='left join (select * from watchlist where watcherID='.Auth::user()->id.') as w on s.productID=w.productID ';
		}else{
			$w=',0 as watched ';
			$query = ' ';
		}
		$sellingEvent = DB::select('
			select s.*,
			p.imageURL,p.productDescription,p.userID '.$w.' 
			from selling as s inner join product as p on s.productID = p.id 
			'.$query.' where s.id ='.$id.''
		);
		return View::make('pages.direct-selling.show',compact('sellingEvent'));
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

	public function listingSteps($step){
		if($step == 'step-1'){
			$category = Category::lists('categoryName','id');
			$subCategories = DB::table('Subcategory')->where('categoryID', 1)->lists('name','id');
			return View::make('pages.direct-selling', compact('category','subCategories','step'));
		}else if($step == 'step-2'){
			$step = 'step-3';
			Session::put('subcategory', Input::get('SubCategory'));
			Session::put('productName', Input::get('productName'));
			Session::put('productDescription', Input::get('productDescription'));
			Session::put('quantity', Input::get('quantity'));
			return View::make('pages.direct-selling-step-2', compact('step'));
		}else if($step == 'step-3'){
			Session::put('sellingName', Input::get('sellingName'));
			Session::put('price', Input::get('price'));
			Session::put('discount', Input::get('discount'));
			Session::put('affiliatePercentage', Input::get('affiliatePercentage'));
			return View::make('pages.direct-selling-step-3');
		}else {
			return Redirect::to('direct-selling');
		}
	}
	public function showDirectSellingListings(){
		//check if there are bidders
		//If bidded, set minimum price to highest bidder
		//else, set minimum price to starting price
		if(Auth::user()){
			$w = ',w.status as watched';
			$query='left join (select * from watchlist where watcherID='.Auth::user()->id.') as w on s.productID=w.productID ';
		}else{
			$w=',0 as watched ';
			$query = ' ';
		}
		$listings = DB::select('
			select s.*,p.userID, p.imageURL,p.productDescription '.$w.' from selling as s 
			inner join product as p on s.productID=p.id '.$query.' 
			where s.sold=0
			order by s.created_at desc limit 4
		');
		if($listings){
			$lastItem = end($listings);
			$lastID = $lastItem->id;
			Session::put('lastID', $lastID);
			return View::make('pages.direct-selling.direct-selling-listings',compact('listings'));
		}
	}
}
