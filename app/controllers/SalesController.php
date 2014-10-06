<?php

class SalesController extends \BaseController {

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
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//check if sales is from auction or selling
		if(Input::get('auctionID')){
			$creditsUsed = 0.00;
			$affiliateCommission = 0.00;
			// dd(Input::get('auctionID'));
			$auction = Auction::find(Input::get('auctionID'));

			$sales = new Sales;
			$sales->amount = $auction->buyoutPrice;
			if(Auth::user()->fund < $sales->amount){
				$creditsAdd = DB::select('select SUM(creditAdded) as added from credits where userID='.Auth::user()->id.'');
				$creditsDeduct = DB::select('select SUM(creditDeducted) as deducted from credits where userID='.Auth::user()->id.'');
				$creditsTotal = (float) $creditsAdd[0]->added - (float) $creditsDeduct[0]->deducted;

				$fundPlusCredits = $creditsTotal + (float) Auth::user()->fund;
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
			$sales->buyerID = Auth::user()->id;
			$sales->transactionNO = time();

			//add commission to affiliate if affiliated
			if(Session::get('affiliate')){
				$affiliateCommission = (float) $sales->amount * ((float) $auction->affiliatePercentage/100);
				$affiliateID = DB::select('select id from affiliates where referralLink = '.Session::get('affiliate').' 
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
			$buyer = User::find(Auth::user()->id);
			if($creditsUsed != 0.00){
				$buyer->fund = 0.00;
			}else{
				$buyer->fund -= (float) $sales->amount;
			}
			$buyer->save();

			//add credits to buyer
			$credits = new Credits;
			$credits->userID = Auth::user()->id;
			$credits->salesID = $sales->id;
			$credits->creditAdded = ((float) $sales->amount * 0.01);
			if($creditsUsed){
				$credits->creditDeducted = $creditsUsed;
			}
			$credits->save();

			//total credits
			$creditsAdded = DB::select('select SUM(creditAdded) as added from credits where userID='.Auth::user()->id.'');
			$creditsDeducted = DB::select('select SUM(creditDeducted) as deducted from credits where userID='.Auth::user()->id.'');
			$totalCredits = (float) $creditsAdded[0]->added - (float) $creditsDeducted[0]->deducted;

			//deduct company commission
			$companyCommission = ((float) $sales->amount * 0.09);

			//add funds to the seller
			$totalAmount = (((float) $sales->amount - $companyCommission) - (float) $credits->creditAdded) - $affiliateCommission;
			// echo '<pre>';
			// return dd($totalAmount);
			$product = Product::find($auction->productID);
			$seller = User::find($product->userID);
			$seller->fund += $totalAmount;
			// echo '<pre>';
			// return dd($seller->fund);
			$seller->save();

			//set auction event as sold
			$auction->sold = 1;
			$auction->save();
			return View::make('pages.auction.invoice', compact('auction','product','sales','buyer','seller','credits','totalCredits'));
		}
		else if(Input::get('sellingID')){
			$creditsUsed = 0.00;
			$affiliateCommission = 0.00;
			//get price from db
			$selling = Selling::find(Input::get('sellingID'));
			$sales = new Sales;
			//check if the price has discount
			if((float) $selling->discount > 0.00){
				$sales->amount = (float) $selling->price - ((float) $selling->price * ((float) $selling->discount)/100);
			}else{
				$sales->amount = $selling->price;
			}
			if(Auth::user()->fund < $sales->amount){
				$creditsAdd = DB::select('select SUM(creditAdded) as added from credits where userID='.Auth::user()->id.'');
				$creditsDeduct = DB::select('select SUM(creditDeducted) as deducted from credits where userID='.Auth::user()->id.'');
				$creditsTotal = (float) $creditsAdd[0]->added - (float) $creditsDeduct[0]->deducted;

				$fundPlusCredits = $creditsTotal + (float) Auth::user()->fund;
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
			$sales->sellingID = $selling->id;
			$sales->buyerID = Auth::user()->id;
			$sales->transactionNO = time();
			// $sales->save();
			
			//add commission to affiliate if affiliated
			if(Session::get('affiliate')){
				$affiliateCommission = (float) $sales->amount * ((float) $selling->affiliatePercentage/100);
				$affiliateID = DB::select('select id from affiliates where referralLink = '.Session::get('affiliate').' 
								and sellingID = '.Input::get('sellingID').'');
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
			$buyer = User::find(Auth::user()->id);
			if($creditsUsed != 0.00){
				$buyer->fund = 0.00;
			}else{
				$buyer->fund -= (float) $sales->amount;
			}
			$buyer->save();

			//add credits to buyer
			$credits = new Credits;
			$credits->userID = Auth::user()->id;
			$credits->salesID = $sales->id;
			$credits->creditAdded = ((float) $sales->amount * 0.01);
			if($creditsUsed != 0.00){
				$credits->creditDeducted = $creditsUsed;
			}
			$credits->save();

			//total credits
			$creditsAdded = DB::select('select SUM(creditAdded) as added from credits where userID='.Auth::user()->id.'');
			$creditsDeducted = DB::select('select SUM(creditDeducted) as deducted from credits where userID='.Auth::user()->id.'');
			$totalCredits = (float) $creditsAdded[0]->added - (float) $creditsDeducted[0]->deducted;

			//deduct company commission
			$companyCommission = ((float) $sales->amount * 0.09);

			//add funds to the seller
			$totalAmount = (((float) $sales->amount - $companyCommission) - (float) $credits->creditAdded) - $affiliateCommission;
			$product = Product::find($selling->productID);
			$seller = User::find($product->userID);
			$seller->fund += $totalAmount;
			$seller->qouta += $sales->amount;
			//check if qouta is reached
			if($seller->qouta >= 1000){
				//give rewards of 5% of total qouta
				$sellerCredits = new Credits;
				$sellerCredits->userID = $product->userID;
				$sellerCredits->salesID = $sales->id;
				$sellerCredits->creditAdded = (float) $seller->qouta * 0.05;
				$sellerCredits->save();
				//rollback qouta to 0
				$seller->qouta = 0.00;
			}
			$seller->save();
			// dd($seller->fund);
			// echo '<pre>';
			// return dd($sales);
			// ;
			return View::make('pages.direct-selling.invoice', compact('selling','product','sales','buyer','seller','credits','totalCredits'));
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

	public function showInvoice(){
		
	}
}
