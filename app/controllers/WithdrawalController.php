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

class WithdrawalController extends \BaseController {
	
	/**
	 * Display a listing of the resource.
	 * GET /withdrawal
	 *
	 * @return Response
	 */
	public function index()
	{	
		// $user= Auth::user()->id;
		// $fund =DB::select("Select ");
		// $currentPage = Input::get('page') - 1;
		// $pagedData = array_slice($fund, $currentPage * 10, 10);
		// $fund = Paginator::make($pagedData, count($fund), 10);
		// return View::make('funds.index',['fund' => $fund]);
		return View::make('funds.withdrawals');
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /withdrawal/create
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('funds.withdrawal');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /withdrawal
	 *
	 * @return Response
	 */
	public function store()
	{
		$sdkConfig = array(
			"mode" => "sandbox",
			"acct1.UserName" => "admin_api1.digisells.com",
			"acct1.Password" => "1408017508",
			"acct1.Signature" => "AeCea6xAGs-n.GkSEXGeWXluuTzOAQSphFYGiGoMTvunIwAhl6PAZu1P",
			"acct1.AppId" => "APP-80W284485P519543T"
		);
		$input= Input::all();
		$user = Auth::user();

	    $rules = array(
		        'password' => 'required|alphaNum|between:6,16'
		    );
		    $validator = Validator::make(Input::only('password'), $rules);
		    if ($validator->fails()) 
		    {
		        return Redirect::back()->withInput()->withErrors($validator,'password');
		    }else{
			    if (!Hash::check(Input::get('password'), $user->password)) 
		        {
		            return Redirect::back()->withInput()->withFlashMessage('<center><div class="alert alert-danger square">Your password does not match</div></center>');
		        }
		    }
		$getVerifiedStatus = new GetVerifiedStatusRequest();
		$accountIdentifier=new AccountIdentifierType();
		$accountIdentifier->emailAddress = $input['email'];
		$getVerifiedStatus->accountIdentifier=$accountIdentifier;
		$getVerifiedStatus->firstName = $input['firstName'];
		$getVerifiedStatus->lastName = $input['lastName'];
		$getVerifiedStatus->matchCriteria = 'NAME';

		$service  = new AdaptiveAccountsService($sdkConfig);
			try {
				// ## Making API call
				// invoke the appropriate method corresponding to API in service
				// wrapper object
				$response = $service->GetVerifiedStatus($getVerifiedStatus);
			} catch(Exception $ex) {
				require_once 'Common/Error.php';
				exit;
			} 

			// ## Accessing response parameters
			// You can access the response parameters as shown below
		$ack = strtoupper($response->responseEnvelope->ack);
		if($ack != "SUCCESS"){
			return Redirect::back()->withInput()->withFlashMessage('<center><div class="alert alert-danger square">Please provide a verified Paypal Account</div></center>');	
		} 

		$payRequest = new PayRequest();

		$receiver = array();
		$receiver[0] = new Receiver();
		$receiver[0]->amount = $input['amount'];
		$receiver[0]->email = $input['email'];
		$receiverList = new ReceiverList($receiver);
		$payRequest->receiverList = $receiverList; 			
		$payRequest->senderEmail = "admin@digisells.com";

		$requestEnvelope = new RequestEnvelope("en_US");
		$payRequest->requestEnvelope = $requestEnvelope; 
		$payRequest->actionType = "PAY";
		$payRequest->cancelUrl = "http://digisells.com/withdrawal/create";
		$payRequest->returnUrl = "http://digisells.com/withdrawal";
		$payRequest->currencyCode = "USD";
		$payRequest->ipnNotificationUrl = "http://digisells.com/withdrawal";

		
		$adaptivePaymentsService = new AdaptivePaymentsService($sdkConfig);
		$payResponse = $adaptivePaymentsService->Pay($payRequest); 

		$paymentDetailsRequest = new PaymentDetailsRequest($requestEnvelope);
		$paymentDetailsRequest->payKey = $payResponse->payKey;

		$paymentDetailsResponse = $adaptivePaymentsService->PaymentDetails($paymentDetailsRequest);
		
		if(strtoupper($paymentDetailsResponse->status == 'COMPLETED')) {
			// $withdrawal=new Withdrawal;
		 //    $withdrawal->userID=Auth::user()->id;
		 //    $withdrawal->paymentID = $payment->getId();
		 //    $withdrawal->methodID = 2;
		 //    $withdrawal->amount = $input['amount'];
		 //    $withdrawal->save();
			return Redirect::to('withdrawal/'.$paymentDetailsRequest->payKey);
    	}else{
    	return Redirect::back()->withInput()->withFlashMessage('<center><div class="alert alert-danger square">Something has gone wrong.</div></center>');	

    	}
	}


	/**
	 * Display the specified resource.
	 * GET /withdrawal/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$sdkConfig = array(
			"mode" => "sandbox",
			"acct1.UserName" => "admin_api1.digisells.com",
			"acct1.Password" => "1408017508",
			"acct1.Signature" => "AeCea6xAGs-n.GkSEXGeWXluuTzOAQSphFYGiGoMTvunIwAhl6PAZu1P",
			"acct1.AppId" => "APP-80W284485P519543T"
		);
		$requestEnvelope = new RequestEnvelope("en_US");
		$paymentDetailsRequest = new PaymentDetailsRequest($requestEnvelope);
		$paymentDetailsRequest->payKey = $id;
		$adaptivePaymentsService = new AdaptivePaymentsService($sdkConfig);
		$paymentDetailsResponse = $adaptivePaymentsService->PaymentDetails($paymentDetailsRequest);
		return View::make('funds.showWithdrawal',['withdrawal'=>$paymentDetailsResponse]);
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /withdrawal/{id}/edit
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
	 * PUT /withdrawal/{id}
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
	 * DELETE /withdrawal/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}