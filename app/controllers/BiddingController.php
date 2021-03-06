<?php

// use Acme\Repositories\BiddingRepository;

class BiddingController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	// protected $biddingrepo;

	// public function __construct(BiddingReposity $biddingrepo)
	// {
	// 	$this->biddingrepo =  $biddingrepo;
	// }

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

		// if($this->biddingrepo->nagaddni($121213)){
		// 	retyrn==
		// }
		$reserved = DB::select('
			select SUM(amount) as reservedFund
			from bidding where userID = '.Auth::user()->id.'
			and highestBidder=1
			');
		if((float) $reserved[0]->reservedFund < (float) Auth::user()->fund){
			$bidding = new Bidding;
			//verify the bid if it is higher than the minimum price
			$bidPrice = (float) Input::get('bidPrice');
			$minPrice = (float) Input::get('minPrice');
			$currentFund = (float) Auth::user()->fund;
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
					//check if affiliated
					if(Session::get('affiliate')){
						$affiliate = Affiliate::where('referralLink', '=', Session::get('affiliate'));
						$hasAffiliate = Bidding::where('referredBy','=',$affiliate->userID)
												->where('auctionID','=',Input::get('auctionID'));
						if(!$hasAffiliate){
							$autobid->refferedBy = $affiliate->userID;
						}
					}
					$bidding->save();
					// bidding notification for watchers
					
					//check for outbidders for this auction
					$outbidders = DB::select('
						select maxBid, userID from bidding where auctionID = '.$bidding->auctionID.' 
						and maxBid > '.(float)$bidding->amount.'
						');
					if($outbidders){
						$hasOutBid = 1;
						$autobid = new Bidding;
						$nextBid;
						while ($hasOutBid == 1) {							
							foreach ($outbidders as $outbidder) {
								//get the highest maxBid
								$highestMaxBid = DB::select('
								select MAX(maxBid) as maxBid from bidding 
								where auctionID = '.$bidding->auctionID.'
								and userID = '.$outbidder->userID.' 
								');
								//get the highest bid
								$highestBid = DB::select('
									Select b.amount,b.userID,a.incrementation from bidding as b 
									inner join auction as a on b.auctionID=a.id
									where b.auctionID = '.$bidding->auctionID.'
									and b.highestBidder = 1
								');
								// dd($highestBid);
								//calculate the next bid with increment
								if($highestBid[0]->incrementation <= 0){
									$nextBid = ((float)$highestBid[0]->amount * 0.05) + (float)$highestBid[0]->amount;
								}else{
									$nextBid = ((float)$highestBid[0]->amount + (float)$highestBid[0]->incrementation);
								}
								//if each outbid is > than the next bid save the auto outbid
								if((float)$highestMaxBid[0]->maxBid > $nextBid){
									// dd($nextBid);
									//outbid again the highest bidder
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
									//save the latest highest bidding
									$autobid->auctionID = $bidding->auctionID;
									$autobid->userID = $outbidder->userID;
									$autobid->amount = $nextBid;
									$autobid->highestBidder = 1;
									$autobid->save();
								}
							}
							//check again for outbidders
							$outbidders = DB::select('
								select maxBid, userID from bidding where auctionID = '.$bidding->auctionID.' 
								and maxBid > '.$nextBid.'
							');
							// dd($outbidders);
							if(count($outbidders) <= 1){
								$hasOutBid = 0;
							}else{
								$hasOutBid = 1;
							}
						}	
					}
					// bidding notifications
					$id=Input::get('auctionID');
					$watchers=DB::select("select a.watcherID,b.id from watchlist as a 
										inner join auction as b on a.productID=b.productID where 
										b.id=".$id." and status=1");
					$auction=Auction::find($id);
					// notifications for all watchers
					foreach($watchers as $watcher){
						$thisuser = User::find($watcher->watcherID);
							if($watcher->watcherID!=$highestBidder->userID && $watcher->watcherID!=Auth::user()->id){
								$thisuser->newNotification()
							    ->withType('NewBidding')
							    ->withSubject('Someone')
							    ->withBody("Placed a new bid for <a href='auction-listing/".$auction->id."'> <b>".$auction->auctionName." </b> </a>")
							    ->regarding($auction)
							    ->deliver();
						    }
					}
					$winner = DB::select('
						select userID from bidding 
						where amount = (Select MAX(amount) from bidding where auctionID = '.Input::get('auctionID').')
						and auctionID = '.Input::get('auctionID').'
						');
					//notification for the outbidded  and winning user
						$outbidded = User::find($highestBidder->userID);
						$outbidded->newNotification()
						    ->withType('Outbidded')
						    ->withSubject('Someone')
						    ->withBody("has outbidded you for <a href='auction-listing/".$auction->id."'> <b>".$auction->auctionName." </b> </a>")
						    ->regarding($auction)
						    ->deliver();

						if(Auth::user()->id==$highestBidder->userID){
							$newwinner=User::find($winner[0]->userID);
							$newwinner->newNotification()
							    ->withType('NewBidding')
							    ->withSubject('Someone')
							    ->withBody("Placed a new bid for <a href='auction-listing/".$auction->id."'> <b>".$auction->auctionName." </b> </a> (outbidded)")
							    ->regarding($auction)
							    ->deliver();
						}	    
						$ownerdb = DB::select('select a.userID from product as a inner join auction as b 
							on a.id=b.productID where b.id='.$id);
						$owner=User::find($ownerdb[0]->userID);
							$owner->newNotification()
						    ->withType('Outbidded')
						    ->withSubject(Auth::user()->username)
						    ->withBody("has bidded on your <a href='auction-listing/".$auction->id."'> <b>".$auction->auctionName." </b> </a>")
						    ->regarding($auction)
						    ->deliver();

					Session::put('auctionID', Input::get('auctionID'));
					return Redirect::action('AuctionController@show',[Input::get('auctionID')]);
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
						Ohh Snap!.. Possible cause of error:<br>
							1. Insufficient Fund - for security reasons we obliged buyers to add funds before they can participate a bidding.<br>
							2. Your current fund is being reserved for other bid you placed. Please wait until those auctions will end<br>
						<div class="btn-group">
							<a href="/payment/create" <button class="btn btn-success" id="addFund">Add Funds</button></a>
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
	public function placeMaxBid(){
		//check if user has enough funds to bid
		if((float)Auth::user()->fund == 0) {
			Session::put('auctionID', Input::get('auctionID'));
				return Redirect::action('AuctionController@show',[Input::get('auctionID')])
				->withFlashMessage('
					<div class="alert alert-danger square error-bid" role="alert">
						<b>Ohh Snap!..Insufficient Fund!</b><br>
						<a href="/payment/create" <button class="btn btn-success" id="addFund">Add Funds</button></a>
					</div>
				');
		}
			//check for reserved funds
			$reserved = DB::select('
				select SUM(amount) as reservedFund
				from bidding where userID = '.Auth::user()->id.'
				and highestBidder=1
			');
			if((float) $reserved[0]->reservedFund < (float) Auth::user()->fund){
				//save a new maxbid
				$maxBidding = new Bidding;
				$maxBidding->auctionID = Input::get('auctionID');
				$maxBidding->userID = Auth::user()->id;
				$maxBidding->amount = 0.000;
				$maxBidding->maxBid = Input::get('bidPrice');
				$maxBidding->highestBidder = 0;
				$maxBidding->save();
				//update highest bidder
				$outbidders = DB::select('
					select maxBid, userID from bidding where auctionID = '.Input::get("auctionID").' 
					and maxBid > '.Input::get("minPrice").'
					');
				
				if($outbidders){
					$hasOutBid = 1;
					$autobid = new Bidding;
					//check if affiliated
					if(Session::get('affiliate')){
						$affiliate = Affiliate::where('referralLink', '=', Session::get('affiliate'));
						$hasAffiliate = Bidding::where('referredBy','=',$affiliate->userID)
												->where('auctionID','=',Input::get('auctionID'));
						if(!$hasAffiliate){
							$autobid->refferedBy = $affiliate->userID;
						}
					}
					$nextBid = (float)Input::get("minPrice");
					while ($hasOutBid == 1) {							
						foreach ($outbidders as $outbidder) {
							//get the highest maxBid
							$highestMaxBid = DB::select('
							select MAX(maxBid) as maxBid from bidding 
							where auctionID = '.Input::get("auctionID").'
							and userID = '.$outbidder->userID.' 
							');
							//get the highest bid
							$highestBid = DB::select('
								Select b.amount,b.userID,a.incrementation from bidding as b 
								inner join auction as a on b.auctionID=a.id
								where b.auctionID = '.Input::get("auctionID").'
								and b.highestBidder = 1
							');
							// dd($highestBid);
							//calculate the next bid with increment
							// if($highestBid[0]->incrementation <= 0){
							// 	$nextBid = ((float)Input::get("minPrice") * 0.05) + (float)Input::get("minPrice");
							// }else{
							// 	$nextBid = ((float)Input::get("minPrice") + (float)$highestBid[0]->incrementation);
							// }
							// dd((float)Input::get("minPrice"));
							//if each outbid is > than the next bid save the auto outbid
							if((float)$highestMaxBid[0]->maxBid > $nextBid){
								// dd($nextBid);
								//save the latest highest bidding
								$autobid->auctionID = Input::get("auctionID");
								$autobid->userID = $outbidder->userID;
								$autobid->amount = $nextBid;
								$autobid->highestBidder = 1;
								$autobid->save();
							}
						}
						//check again for outbidders
						$outbidders = DB::select('
							select maxBid, userID from bidding where auctionID = '.Input::get("auctionID").' 
							and maxBid > '.$nextBid.'
						');
						// dd($outbidders);
						if(count($outbidders) <= 1){
							//update the maxbid
							//outbid again the highest bidder
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
							DB::update(DB::raw('update bidding set highestBidder=1 where amount='.$nextBid.' and auctionID='.Input::get("auctionID").''));
							DB::update(DB::raw('update bidding set highestBidder=0 where amount<'.$nextBid.' and auctionID='.Input::get("auctionID").''));
							$hasOutBid = 0;
							// dd($nextBid);
						}else{
							//calculate the next bid with increment
							if($highestBid[0]->incrementation <= 0){
								$nextBid = ($nextBid * 0.05) + $nextBid;
							}else{
								$nextBid = $nextBid + (float)$highestBid[0]->incrementation;
							}
							$hasOutBid = 1;
						}
					}
				}
				$id=Input::get('auctionID');
				$maxbidded=DB::select('select userID from bidding where
					auctionID='.$id.' order by amount desc limit 1');
				$outbidded=DB::select('select userID from bidding where
					auctionID='.$id.' and highestBidder=0 and userID !='.$maxbidded[0]->userID.' order by amount desc limit 1');
				$watchers=DB::select("select a.watcherID,b.id from watchlist as a 
										inner join auction as b on a.productID=b.productID where 
										b.id=".$id." and status=1");
				$auction=Auction::find($id);
					// notifications for all watchers
				if($watchers){
					foreach($watchers as $watcher){
							$thisuser = User::find($watcher->watcherID);
							if($watcher->watcherID!=$outbidded[0]->userID && $watcher->watcherID!=$maxbidded[0]->userID){
								$thisuser->newNotification()
							    ->withType('NewBidding')
							    ->withSubject('Someone')
							    ->withBody("Placed a new bid for <a href='auction-listing/".$auction->id."'> <b>".$auction->auctionName." </b> </a>")
							    ->regarding($auction)
							    ->deliver();
						    }
					}}
						if($maxbidded && $maxbidded[0]->userID!=Auth::user()->id){
							$winner=User::find($maxbidded[0]->userID);
							$winner->newNotification()
							    ->withType('NewBidding')
							    ->withSubject('Someone')
							    ->withBody("Placed a new bid for <a href='auction-listing/".$auction->id."'> <b>".$auction->auctionName." </b> </a> (outbidded)")
							    ->regarding($auction)
							    ->deliver();
							  }  
						if($outbidded){
							$loser = User::find($outbidded[0]->userID);
							$loser->newNotification()
						    ->withType('Outbidded')
						    ->withSubject('Someone')
						    ->withBody("has outbidded you for <a href='auction-listing/".$auction->id."'> <b>".$auction->auctionName." </b> </a>")
						    ->regarding($auction)
						    ->deliver();
							}
						$ownerdb = DB::select('select a.userID from product as a inner join auction as b 
							on a.id=b.productID where b.id='.$id);
						$owner=User::find($ownerdb[0]->userID);
							$owner->newNotification()
						    ->withType('Outbidded')
						    ->withSubject(Auth::user()->username)
						    ->withBody("has bidded on your <a href='auction-listing/".$auction->id."'> <b>".$auction->auctionName." </b> </a>")
						    ->regarding($auction)
						    ->deliver();
				Session::put('auctionID', Input::get('auctionID'));
				return Redirect::action('AuctionController@show',[Input::get('auctionID')]);
			}
	}
}

// if($prevBid){
// 					//update the maxBid of his previous bid
// 					$maxBidding = Bidding::find($prevBid[0]->id);
// 					$maxBidding->maxBid = Input::get('bidPrice');
// 					$maxBidding->save();
// 					//update highest bidder
// 					$outbidders = DB::select('
// 						select maxBid, userID from bidding where auctionID = '.Input::get("auctionID").' 
// 						and maxBid > '.Input::get("minPrice").'
// 						');
// 					if($outbidders){
// 						$hasOutBid = 1;
// 						$autobid = new Bidding;
// 						$nextBid;
// 						while ($hasOutBid == 1) {							
// 							foreach ($outbidders as $outbidder) {
// 								//get the highest maxBid
// 								$highestMaxBid = DB::select('
// 								select MAX(maxBid) as maxBid from bidding 
// 								where auctionID = '.Input::get("auctionID").'
// 								and userID = '.$outbidder->userID.' 
// 								');
// 								//get the highest bid
// 								$highestBid = DB::select('
// 									Select b.amount,b.userID,a.incrementation from bidding as b 
// 									inner join auction as a on b.auctionID=a.id
// 									where b.auctionID = '.Input::get("auctionID").'
// 									and b.highestBidder = 1
// 								');
// 								// dd($highestBid);
// 								//calculate the next bid with increment
// 								if($highestBid[0]->incrementation <= 0){
// 									$nextBid = ((float)Input::get("minPrice") * 0.05) + (float)Input::get("minPrice");
// 								}else{
// 									$nextBid = ((float)Input::get("minPrice") + (float)$highestBid[0]->incrementation);
// 								}
// 								// dd($nextBid);
// 								//if each outbid is > than the next bid save the auto outbid
// 								if((float)$highestMaxBid[0]->maxBid > $nextBid){
// 									// dd($nextBid);
// 									//outbid again the highest bidder
// 									$currentHighestBidder = DB::select('
// 										select id from bidding 
// 										where amount = (Select MAX(amount) from bidding where auctionID = '.Input::get('auctionID').')
// 										and auctionID = '.Input::get('auctionID').'
// 									');
// 									if($currentHighestBidder){
// 										$highestBidder = Bidding::find($currentHighestBidder[0]->id);
// 										$highestBidder->highestBidder = 0;
// 										$highestBidder->save();
// 									}
// 									//save the latest highest bidding
// 									$autobid->auctionID = Input::get("auctionID");
// 									$autobid->userID = $outbidder->userID;
// 									$autobid->amount = $nextBid;
// 									$autobid->highestBidder = 1;
// 									$autobid->save();
// 								}
// 							}
// 							//check again for outbidders
// 							$outbidders = DB::select('
// 								select maxBid, userID from bidding where auctionID = '.Input::get("auctionID").' 
// 								and maxBid > '.$nextBid.'
// 							');
// 							// dd($outbidders);
// 							if(count($outbidders) <= 1){
// 								$hasOutBid = 0;
// 							}else{
// 								$hasOutBid = 1;
// 							}
// 						}
// 						Session::put('auctionID', Input::get('auctionID'));
// 						return Redirect::action('AuctionController@show',[Input::get('auctionID')]);
// 						}
// 				}
// 				else 
// 				{
// 					//else save a new maxbid
// 					$maxBidding = new Bidding;
// 					$maxBidding->auctionID = Input::get('auctionID');
// 					$maxBidding->userID = Auth::user()->id;
// 					$maxBidding->amount = 0.000;
// 					$maxBidding->maxBid = Input::get('bidPrice');
// 					// $maxBidding->highestBidder = 0;
// 					$maxBidding->save();
// 					//update highest bidder
// 					$outbidders = DB::select('
// 						select maxBid, userID from bidding where auctionID = '.Input::get("auctionID").' 
// 						and maxBid > '.Input::get("minPrice").'
// 						');
// 					if($outbidders){
// 						$hasOutBid = 1;
// 						$autobid = new Bidding;
// 						$nextBid;
// 						while ($hasOutBid == 1) {							
// 							foreach ($outbidders as $outbidder) {
// 								//get the highest maxBid
// 								$highestMaxBid = DB::select('
// 								select MAX(maxBid) as maxBid from bidding 
// 								where auctionID = '.Input::get("auctionID").'
// 								and userID = '.$outbidder->userID.' 
// 								');
// 								//get the highest bid
// 								$highestBid = DB::select('
// 									Select b.amount,b.userID,a.incrementation from bidding as b 
// 									inner join auction as a on b.auctionID=a.id
// 									where b.auctionID = '.Input::get("auctionID").'
// 									and b.highestBidder = 1
// 								');
// 								// dd($highestBid);
// 								//calculate the next bid with increment
// 								if($highestBid[0]->incrementation <= 0){
// 									$nextBid = ((float)Input::get("minPrice") * 0.05) + (float)Input::get("minPrice");
// 								}else{
// 									$nextBid = ((float)Input::get("minPrice") + (float)$highestBid[0]->incrementation);
// 								}
// 								// dd($nextBid);
// 								//if each outbid is > than the next bid save the auto outbid
// 								if((float)$highestMaxBid[0]->maxBid > $nextBid){
// 									// dd($nextBid);
// 									//outbid again the highest bidder
// 									$currentHighestBidder = DB::select('
// 										select id from bidding 
// 										where amount = (Select MAX(amount) from bidding where auctionID = '.Input::get('auctionID').')
// 										and auctionID = '.Input::get('auctionID').'
// 									');
// 									if($currentHighestBidder){
// 										$highestBidder = Bidding::find($currentHighestBidder[0]->id);
// 										$highestBidder->highestBidder = 0;
// 										$highestBidder->save();
// 									}
// 									//save the latest highest bidding
// 									$autobid->auctionID = Input::get("auctionID");
// 									$autobid->userID = $outbidder->userID;
// 									$autobid->amount = $nextBid;
// 									$autobid->highestBidder = 1;
// 									$autobid->save();
// 								}
// 							}
// 							//check again for outbidders
// 							$outbidders = DB::select('
// 								select maxBid, userID from bidding where auctionID = '.Input::get("auctionID").' 
// 								and maxBid > '.$nextBid.'
// 							');
// 							// dd($outbidders);
// 							if(count($outbidders) <= 1){
// 								$hasOutBid = 0;
// 							}else{
// 								$hasOutBid = 1;
// 							}
// 						}
// 					}