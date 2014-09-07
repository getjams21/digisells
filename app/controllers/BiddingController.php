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
		//check fo reserved funds
		$reserved = DB::select('
			select SUM(amount) as reservedFund
			from bidding where userID = '.Auth::user()->id.'
			and highestBidder=1
			');
		if((float) $reserved[0]->reservedFund < (float) Config::get('currentfund')){
			$bidding = new Bidding;
			//verify the bid if it is higher than the minimum price
			$bidPrice = (float) Input::get('bidPrice');
			$minPrice = (float) Input::get('minPrice');
			$currentFund = (float) Config::get('currentfund');
			if($currentFund >= $minPrice){
				if($bidPrice >= $minPrice){
					//update highest bidder
					$currentHighestBidder = DB::select('
						select id from bidding 
						where amount = (Select MAX(amount) from bidding where auctionID = '.Input::get('auctionID').')
						and auctionID = '.Input::get('auctionID').'
						');
					if($currentHighestBidder){
						$highestBidder = Bidding::find($currentHighestBidder[0]->id);
						$highestBidder->highestBidder = 0;
						$highestBidder->save();
					}
					$bidding->auctionID = Input::get('auctionID');
					$bidding->userID = Auth::user()->id;
					$bidding->amount = Input::get('bidPrice');
					$bidding->highestBidder = 1;
					$bidding->save();
					//check for outbidders for this auction
					$outbidders = DB::select('
						select maxBid, userID from bidding where auctionID = '.$bidding->auctionID.' 
						and maxBid > '.(float)$bidding->amount.'
						');
					if($outbidders){
						$hasOutBid = 1;
						$autobid = new Bidding;
						while ($hasOutBid == 1) {
							$currentHighestBidder = DB::select('
								select id from bidding 
								where amount = (Select MAX(amount) from bidding where auctionID = '.Input::get('auctionID').')
								and auctionID = '.Input::get('auctionID').'
							');
							if($currentHighestBidder){
								$highestBidder = Bidding::find($currentHighestBidder[0]->id);
								$highestBidder->highestBidder = 0;
								$highestBidder->save();
							}
							// foreach ($outbidders as $outbidder) {
							// 	//get the highest maxBid
							// 	$highestMaxBid = DB::select('
							// 	select MAX(maxBid) as maxBid from bidding 
							// 	where auctionID = '.$bidding->auctionID.'
							// 	and userID = '.$outbidder->userID.' 
							// 	');
							// 	//get the highest bid
							// 	$highestBid = DB::select('
							// 		Select amount,userID from bidding where auctionID = '.$bidding->auctionID.'
							// 		and highestBidder = 1
							// 	');
							// 	//calculate the next bid with increment
							// 	$nextBid = ((float)$highestBid[0]->amount * 0.05) + (float)$highestBid[0]->amount;
							// 	//if each outbid is > than the next bid save the auto outbid
							// 	if((float)$highestMaxBid[0]->maxBid > $nextBid){
							// 		$autobid->auctionID = $bidding->auctionID;
							// 		$autobid->userID = $outbidder->userID;
							// 		$autobid->amount = $nextBid;
							// 		// $autobid->highestBidder = 1;
							// 		$autobid->save();
							// 	}
							// }
							// //check again for outbidders
							// $outbidders = DB::select('
							// 	select maxBid, userID from bidding where auctionID = '.$bidding->auctionID.' 
							// 	and maxBid > '.(float)$autobid->amount.'
							// ');
							// if($outbidders->count() == 1){
							// 	$hasOutBid = 0;
							// }else{
							// 	$hasOutBid = 1;
							// }
						}
					}
					// if($outbidders->count()){
					
					// }
					Session::put('auctionID', Input::get('auctionID'));
					return Redirect::action('AuctionController@show',[Input::get('auctionID')])
						->withFlashMessage('<div class="alert alert-success square error-bid" role="alert"><b>Horray! You are the current highest bidder!</b></div>');
				}
				else{
					Session::put('auctionID', Input::get('auctionID'));
					return Redirect::action('AuctionController@show',[Input::get('auctionID')])
					->withFlashMessage('
						<div class="alert alert-danger square error-bid" role="alert">
							<b>Ohh Snap!..Your bid is too low!</b>
						</div>
					');
				}
			}else{
				Session::put('auctionID', Input::get('auctionID'));
					return Redirect::action('AuctionController@show',[Input::get('auctionID')])
					->withFlashMessage('
						<div class="alert alert-danger square error-bid" role="alert">
							<b>Ohh Snap!..Insufficient Fund!</b><br>
							<a href="/payment/create" <button class="btn btn-success" id="addFund">Add Funds</button></a>
						</div>
					');
			}
		}else{
			Session::put('auctionID', Input::get('auctionID'));
				return Redirect::action('AuctionController@show',[Input::get('auctionID')])
				->withFlashMessage('
					<div class="alert alert-danger square error-bid" role="alert">
						<b>Ohh Snap!..Insufficient Fund! Your current fund is being reserved for other bid you placed. Please wait until those auctions will end or </b><br>
						<div class="btn-group">
							<a href="/payment/create" <button class="btn btn-success" id="addFund">Add Funds</button></a>
							<a href="/payment/create" <button class="btn btn-warning" id="viewBids">Review Bids</button></a>
						</div>
					</div>
				');
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
