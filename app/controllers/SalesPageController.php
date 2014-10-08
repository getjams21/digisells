<?php
use PayPal\Types\AP\PayRequest;
use PayPal\Types\AP\Receiver;
use PayPal\Types\AP\ReceiverList;
use PayPal\Types\Common\RequestEnvelope;
use PayPal\Service\AdaptivePaymentsService;
use PayPal\Types\AP\PaymentDetailsRequest;
class SalesPageController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		
		if(Session::has('productID') && Session::has('sellingID')){
			$product = Product::find(Session::get('productID'));
			$selling = Selling::find(Session::get('sellingID'));
			$amountP = $selling->price - ($selling->price * ($selling->discount  / 100));
			$amountPay = $amountP *.01;
			$payRequest = new PayRequest();
			$receiver = array();
			$receiver[0] = new Receiver();
			$receiver[0]->amount = $amountPay;
			$receiver[0]->email = "digisells@admin.com";
			
			$receiverList = new ReceiverList($receiver);
			$payRequest->receiverList = $receiverList;

			$requestEnvelope = new RequestEnvelope("en_US");
			$payRequest->requestEnvelope = $requestEnvelope; 
			$payRequest->actionType = "PAY";
			$payRequest->cancelUrl = "http://digisells.com/direct-selling?cancel=true";
			$payRequest->returnUrl = "http://digisells.com/paySelling?success=true";
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
			$selling->payKey = $payResponse->payKey;
			$selling->save();
			Session::put('payKey', $payResponse->payKey);
			return Redirect::away('https://www.sandbox.paypal.com/webscr?cmd=_ap-payment&paykey='.$payResponse->payKey);
		
		}else{
			return Redirect::to('direct-selling');
		}
	}
	public function paySelling(){
		$product = Product::find(Session::get('productID'));
		$selling = Selling::find(Session::get('sellingID'));
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
	         return Redirect::to('direct-selling')->withFlashMessage('<center><div class="alert alert-danger square"><b>Request Timeout!</b> Please check your Internet Connections.</div></center>');
		}
		if($paymentDetailsResponse->status=='COMPLETED'){
		    $selling->paid=1;
		    $selling->payKey = $payKey;
		    $selling->save();
			return View::make('pages.product.sales-page-default', compact('product','selling'));

		}else{
			return Redirect::to('direct-selling')->withFlashMessage('<center><div class="alert alert-danger square"><b>Request Timeout!</b> Something went wrong.</div></center>');
		}
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


}
