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
  					$auction->startDate = Input::get('startDate');
  					$auction->endDate = Input::get('endDate');
  					$auction->incrementation = Input::get('incrementation');
  					$auction->affiliatePercentage = Input::get('affiliatePercentage');

  					$auction->save();
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
		//
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

}
