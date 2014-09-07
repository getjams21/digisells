<?php

class BiddingController extends \BaseController {

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
		
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//verify the bid if it is higher than the minimum price
		$bidPrice = (float) Input::get('bidPrice');
		$minPrice = (float) Input::get('minPrice');
		if($bidPrice >= $minPrice){
			$bidding = new Bidding;
			$bidding->auctionID = Input::get('auctionID');
			$bidding->userID = Auth::user()->id;
			$bidding->amount = Input::get('bidPrice');
			$bidding->save();
			Session::put('auctionID', Input::get('auctionID'));
			return Redirect::action('AuctionController@show',[Input::get('auctionID')])
				->withFlashMessage('<div class="alert alert-success square error-bid" role="alert"><b>Horray! You are the current highest bidder!</b></div>');
		}
		else{
			Session::put('auctionID', Input::get('auctionID'));
			// dd(Session::get('auctionID'));
			return Redirect::action('AuctionController@show',[Input::get('auctionID')])->withFlashMessage('<div class="alert alert-danger square error-bid" role="alert"><b>Oopps..Your bid is too low!</b></div>');
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


}
