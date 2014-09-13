<?php namespace Acme\Repositories;

class BiddingRepository
{

	public function nagAddnisiya($number1){

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
					$bidding->save();
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
	}
}