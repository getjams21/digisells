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

		}
		else if(Input::get('sellingID')){
			//get price from db
			$selling = Selling::find(Input::get('sellingID'));
			$sales = new Sales;
			//check if the price has discount
			if((float) $selling->discount > 0.00){
				$sales->amount = (float) $selling->price - ((float) $selling->price * ((float) $selling->discount)/100);
			}else{
				$sales->amount = $selling->price;
			}
			$sales->sellingID = $selling->id;
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
			$product = Product::find($selling->productID);
			$seller = User::find($product->userID);
			$seller->fund += $totalAmount;
			$seller->save();
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
