<?php
use PayPal\Types\AP\PayRequest;
use PayPal\Types\AP\Receiver;
use PayPal\Types\AP\ReceiverList;
use PayPal\Types\Common\RequestEnvelope;
use PayPal\Service\AdaptivePaymentsService;
use PayPal\Types\AP\PaymentDetailsRequest;
use PayPal\Types\AA\GetVerifiedStatusRequest;
use PayPal\Types\AA\AccountIdentifierType;
use PayPal\Service\AdaptiveAccountsService;
// use Acme\Mailers\SellerMailer as Mailer;
class SalesController extends \BaseController {

	// function __construct(Mailer $mailer)
	// 	{
	// 		$this->mailer = $mailer;
		
	// 	}
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
			$auction = Auction::find(Input::get('auctionID'));
			$amount = $auction->buyoutPrice;
			if(Session::get('affiliate')){
				$affiliateCommission = (float) $amount * ((float) $auction->affiliatePercentage/100);
				$affiliate = DB::select('select id from affiliates where referralLink = '.Session::get('affiliate').' 
								and auctionID = '.Input::get('auctionID').'');
			
				if($affiliate){
					$affiliateID=$affiliate[0]->id;
				}else{
					$affiliateID=null;
				}
			}else{
				$affiliateID=null;
				$affiliateCommission = null;
			}
			$auction= Auction::find(Input::get('auctionID'));
			$product = Product::find($auction->productID);
			$seller = User::find($product->userID);
			Session::put('pay',['sellingID'=> null,
								'auctionID'=> Input::get('auctionID'),
								'amount'=>$amount,
								'sellerID'=>$seller->id,
								'creditsUsed'=>$creditsUsed,
								'affiliateID' =>$affiliateID,
								'affCommision'=>$affiliateCommission
								]);
			return Redirect::to('/pay');

		}
		else if(Input::get('sellingID')){
			$creditsUsed = 0.00;
			$affiliateCommission = 0.00;
			//get price from db
			$selling = Selling::find(Input::get('sellingID'));
			//check if the price has discount
			if((float) $selling->discount > 0.00){
				$amount = (float) $selling->price - ((float) $selling->price * ((float) $selling->discount)/100);
			}else{
				$amount = $selling->price;
			}
			$amount -= $creditsUsed;
			//IF it has affiliate
			if(Session::get('affiliate')){
				$affiliateCommission = (float) $amount * ((float) $selling->affiliatePercentage/100);
				$affiliate = DB::select('select id from affiliates where referralLink = '.Session::get('affiliate').' 
								and sellingID = '.Input::get('sellingID').'');
				if($affiliate){
					$affiliateID=$affiliate[0]->id;
				}else{
					$affiliateID=null;
				}
			}else{
				$affiliateID=null;
				$affiliateCommission = null;
			}
			//PAYPAL PAYMENT
			$selling= Selling::find(Input::get('sellingID'));
			$product = Product::find($selling->productID);
			$seller = User::find($product->userID);
			Session::put('pay',['sellingID'=> Input::get('sellingID'),
								'auctionID'=> null,
								'amount'=>$amount,
								'sellerID'=>$seller->id,
								'creditsUsed'=>$creditsUsed,
								'affiliateID' =>$affiliateID,
								'affCommision'=>$affiliateCommission
								]);
			// $session = Session::get("pay");
			// dd($session['sellingID']);
			return Redirect::to('/pay');
		}
	}
	public function payBid($id){
		$sales = Sales::find($id);
		Session::put('bid', $id);
		$creditsUsed = 0.00;
		$affiliateCommission = 0.00;
		$auction = Auction::find($sales->auctionID);
		$product = Product::find($auction->productID);
			$seller = User::find($product->userID);
			$amount = $sales->amount;
			if(Session::get('affiliate')){
				$affiliateCommission = (float) $amount * ((float) $auction->affiliatePercentage/100);
				$affiliate = DB::select('select id from affiliates where id = '.$sales->affiliateID.' 
								and auctionID = '.$auction->id.'');
			
				if($affiliate){
					$affiliateID=$affiliate[0]->id;
				}else{
					$affiliateID=null;
				}
			}else{
				$affiliateID=null;
				$affiliateCommission = null;
			}

		Session::put('pay',['sellingID'=> null,
								'auctionID'=> $sales->auctionID,
								'amount'=>$sales->amount,
								'sellerID'=>$seller->id,
								'creditsUsed'=>$creditsUsed,
								'affiliateID' =>$sales->affiliateID,
								'affCommision'=>$affiliateCommission
								]);
			// $session = Session::get("pay");
			// dd($session['sellingID']);
			return Redirect::to('/pay');
	}
 	public function pay(){
 			$session = Session::get("pay");
 			$payRequest = new PayRequest();
 			$seller = User::find($session['sellerID']);
 			// return dd($settings->company);
 			//company
			$receiver = array();
			$receiver[0] = new Receiver();
			$receiver[0]->amount = $session['amount'] * 0.1;
			$receiver[0]->email = "digisells@admin.com";
			if($session['affiliateID']){
				$affiliate = Affiliate::find($session['affiliateID']);
				$aff = User::find($affiliate->userID);
				$receiver[1] = new Receiver();
				$receiver[1]->amount = ($session['amount'] - ($session['amount'] * 0.1)) - $session['affCommision'];
				$receiver[1]->email = $seller->paypal;

				$receiver[2] = new Receiver();
				$receiver[2]->amount = $session['affCommision'];
				$receiver[2]->email = $aff->paypal;
			}else{
				$receiver[1] = new Receiver();
				$receiver[1]->amount = $session['amount'] - ($session['amount'] * 0.1);
				$receiver[1]->email = $seller->paypal;
			}
			$receiverList = new ReceiverList($receiver);
			$payRequest->receiverList = $receiverList;
			$requestEnvelope = new RequestEnvelope("en_US");
			$payRequest->requestEnvelope = $requestEnvelope; 
			$payRequest->actionType = "PAY";
			$payRequest->cancelUrl = "http://digisells.com?cancel=true";
			$payRequest->returnUrl = "http://digisells.com/sales-return?success=true";
			$payRequest->currencyCode = "USD";
			$payRequest->ipnNotificationUrl = "http://replaceIpnUrl.com";

			$sdkConfig = array(
				"mode" => "sandbox",
				"acct1.UserName" => "digisells_api1.admin.com",
				"acct1.Password" => "PFT5XFQ42YDDEJYM",
				"acct1.Signature" => "An5ns1Kso7MWUdW4ErQKJJJ4qi4-AfQR4MeCy8ViZ7PE4umi3Me1o3PU",
				"acct1.AppId" => "APP-80W284485P519543T"
			);
			$adaptivePaymentsService = new AdaptivePaymentsService($sdkConfig);
			$payResponse = $adaptivePaymentsService->Pay($payRequest); 
			Session::put('payKey', $payResponse->payKey);
			return Redirect::away('https://www.sandbox.paypal.com/webscr?cmd=_ap-payment&paykey='.$payResponse->payKey);
 	}
	public function returnPP()
	{
		$settings = Settings::find(1);
		$session = Session::get("pay");
		$buyer = Auth::user()->id;

		if(Session::has('buyerID')){
			$buyer = $session['buyerID'];
		}
		$payKey = Session::get("payKey");
			$sdkConfig = array(
				"mode" => "sandbox",
				"acct1.UserName" => "digisells_api1.admin.com",
				"acct1.Password" => "PFT5XFQ42YDDEJYM",
				"acct1.Signature" => "An5ns1Kso7MWUdW4ErQKJJJ4qi4-AfQR4MeCy8ViZ7PE4umi3Me1o3PU",
				"acct1.AppId" => "APP-80W284485P519543T"
			);
		$requestEnvelope = new RequestEnvelope("en_US");
		$paymentDetailsRequest = new PaymentDetailsRequest($requestEnvelope);
		$paymentDetailsRequest->payKey = $payKey;
		$adaptivePaymentsService = new AdaptivePaymentsService($sdkConfig);
		try {
		$paymentDetailsResponse = $adaptivePaymentsService->PaymentDetails($paymentDetailsRequest);
		} catch (PayPal\Exception\PPConnectionException $ex) {
	         return Redirect::back()->withInput()->withFlashMessage('<center><div class="alert alert-danger square"><b>Request Timeout!</b> Please check your Internet Connections.</div></center>');
		}
		// echo '<pre>';
		// return dd($paymentDetailsResponse);
		if($paymentDetailsResponse->status=='COMPLETED'){
			if(Session::get('bid')){
				$id= Session::get('bid');
				$sales = Sales::find($id);
				$sales->payKey = $payKey;
				$sales->save();

			}else{
			$sales = new Sales;
			$sales->sellingID = $session['sellingID'];
			$sales->auctionID = $session['auctionID'];
			$sales->buyerID = $buyer;
			$sales->amount = $session['amount'];
			$sales->transactionNO = time();
			$sales->affiliateID = $session['affiliateID'];
			$sales->payKey = $payKey;
			$sales->save();
			}
			//add credits to buyer
			$credits = new Credits;
			$credits->userID = $buyer;
			$credits->salesID = $sales->id;
			$credits->creditAdded = ((float) $sales->amount * $settings->buyer);
			if($session['creditsUsed'] != 0.00){
				$credits->creditDeducted = $session['creditsUsed'];
			}
			$credits->save();
			if($session['affiliateID']){
				$affiliate = Affiliate::find($session['affiliateID']);
				$affiliate->amount = $session['affCommision'];
				$affiliate->save();
				//update sales record
			}
			$creditsAdded = DB::select('select SUM(creditAdded) as added from credits where userID='.$buyer.'');
			$creditsDeducted = DB::select('select SUM(creditDeducted) as deducted from credits where userID='.$buyer.'');
			$totalCredits = (float) $creditsAdded[0]->added - (float) $creditsDeducted[0]->deducted;

			//deduct company commission
			$companyCommission = ((float) $sales->amount * $settings->company);
			if($session['affCommision']){
				$affCommision = $session['affCommision'];
			}else{
				$affCommision = 0;
			}
			//add funds to the seller
			$totalAmount = (((float) $sales->amount - $companyCommission) - (float) $credits->creditAdded) - $session['affCommision'];
			$seller = User::find($session['sellerID']);
			$seller->fund += $totalAmount;
			$seller->qouta += $sales->amount;
			//check if qouta is reached
			if($seller->qouta >= 1000){
				//give rewards of 5% of total qouta
				$sellerCredits = new Credits;
				$sellerCredits->userID = $seller->id;
				$sellerCredits->salesID = $sales->id;
				$sellerCredits->creditAdded = (float) $seller->qouta * $settings->reward;
				$sellerCredits->save();
				$seller->qouta = 0.00;
			}
			$seller->save();
			$buyer = Auth::user();

			if($session['sellingID'])
			{
				$selling= Selling::find($session['sellingID']);
				$product = Product::find($selling->productID);

				$seller = User::find($product->userID);
				$seller->qouta = $sales->amount;
				$seller->save();
				if($seller->qouta >= 1000){
				//give rewards of 5% of total qouta
					$sellerCredits = new Credits;
					$sellerCredits->userID = $product->userID;
					$sellerCredits->salesID = $sales->id;
					$sellerCredits->creditAdded = (float) $seller->qouta * $settings->reward;
					$sellerCredits->save();
					//rollback qouta to 0
					$seller->qouta = 0.00;
				}
				Mail::send('emails.seller', ['user'=> $seller,'selling' =>$selling,
					'sales' =>$sales], function($message) use($seller){
		        $message->to($seller->email)->subject('Your Digisells Product Has Been Sold.');
		   		 });
				Mail::send('emails.buyer', ['user'=> $buyer,'selling' =>$selling,'product'=>$product,'seller'=>$seller,
					'credits'=>$credits,'totalCredits' => $totalCredits,
					'sales' =>$sales], function($message) use($buyer){
		        $message->to( $buyer->email)->subject('Your Digisells Product Has Been Sold.');
		   		 });
				$seller->save();
				return View::make('pages.direct-selling.invoice', compact('selling','product','sales','seller','credits','totalCredits'));
		 	}else{
				$auction= Auction::find($session['auctionID']);
				$auction->sold=1;
				$auction->save();
				$selling=null;
				$product = Product::find($auction->productID);

				$seller = User::find($product->userID);
				$seller->qouta = $sales->amount;
				$seller->save();
				if($seller->qouta >= 1000){
				//give rewards of 5% of total qouta
					$sellerCredits = new Credits;
					$sellerCredits->userID = $product->userID;
					$sellerCredits->salesID = $sales->id;
					$sellerCredits->creditAdded = (float) $seller->qouta * $settings->reward;
					$sellerCredits->save();
					//rollback qouta to 0
					$seller->qouta = 0.00;
				}

				Mail::send('emails.sellerAuction', ['user'=> $seller,'auction' =>$auction,'selling'=>$selling,
					'sales' =>$sales], function($message) use($seller){
		        $message->to($seller->email)->subject('Your Digisells Product Has Been Sold.');
		   		 });
				Mail::send('emails.buyerAuction', ['user'=> $buyer,'auction' =>$auction,'product'=>$product,'seller'=>$seller,
					'credits'=>$credits,'totalCredits' => $totalCredits,
					'sales' =>$sales], function($message) use($buyer){
		        $message->to( $buyer->email)->subject('Your Digisells Product Has Been Sold.');
		   		 });
				$seller->save();
		 	return View::make('pages.auction.invoice', compact('auction','product','sales','seller','credits','totalCredits'));
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

	public function showInvoice(){
		
	}
}
