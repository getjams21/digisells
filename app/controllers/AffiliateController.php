<?php

class AffiliateController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if(Request::ajax()){
			$affiliate = new Affiliate;
			$affiliate->userID = Auth::user()->id;
			if(Input::get('isSelling') == '1'){
				$affiliate->sellingID = Input::get('val');
				// $selling = Selling::where('id','=',$affiliate->sellingID)->firstOrFail();
			}else {
				$affiliate->auctionID = Input::get('val');
				// $auction = Auction::where('id','=',$affiliate->auctionID)->firstOrFail();
			}
			$affiliate->referralLink = time();
			$affiliate->save();
			$refLink = 'http://digisells.com/selling-affiliate?u='.$affiliate->userID.'&ref='.$affiliate->referralLink;
			return Response::json($refLink);
		}
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
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

	public function showAffiliatedProductForDirectSelling(){
		$refLink = Input::get('ref');
		$affiliate = DB::select('
				select product.id, selling.id as sellingID from product
				inner join selling on selling.productID = product.id
				inner join affiliates on selling.id = affiliates.sellingID
				where affiliates.referralLink = '.$refLink.'
			');
		Session::put('affiliate',$refLink);
		return Redirect::action('DirectSellingController@show',[$affiliate[0]->id]);
	}


}
