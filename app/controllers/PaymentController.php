<?php
class PaymentController extends \BaseController {
	private $_apiContext;
	private $paypal;
    private $_ClientId='ATp6uBApduUYkCLe5iOKhD7lQhfc8kdmKc2dvtlLaCfiYDmmolDMoAu2vwAJ';
    private $_ClientSecret='ENvUWRCSJf06XpAdKaiNtVLAMpB4uvupciqloNExUyQYK13ZRbQ78BcupVst';
    public function __construct()
	    {
    		$this->_apiContext = Paypalpayment::ApiContext(
            Paypalpayment::OAuthTokenCredential(
                $this->_ClientId,
                $this->_ClientSecret
            )
        );
    	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$user= Auth::user()->id;
		$fund =DB::select("select a.*,b.methodName from paypal as a inner join method as b on a.methodID=b.id where a.userID=".$user." and status=1 order by a.created_at desc");
		$currentPage = Input::get('page') - 1;
		$pagedData = array_slice($fund, $currentPage * 10, 10);
		$fund = Paginator::make($pagedData, count($fund), 10);
		return View::make('funds.index',['fund' => $fund]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('funds.payment');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input= Input::all();
		$card = Paypalpayment::CreditCard();
        $card->setType($input['cardType']);
        $card->setNumber($input['cardNumber']);
        $card->setExpire_month($input['month']);
        $card->setExpire_year($input['year']);
        $card->setCvv2($input['cvv2']);
        $card->setFirst_name($input['firstName']);
        $card->setLast_name($input['lastName']);

        $fi = Paypalpayment::FundingInstrument();
        $fi->setCredit_card($card);

        $payer = Paypalpayment::Payer();
        $payer->setPayment_method("credit_card");
        $payer->setFunding_instruments(array($fi));

        $amount = Paypalpayment:: Amount();
        $amount->setCurrency("USD");
        $amount->setTotal($input['amount']);

        $transaction = Paypalpayment:: Transaction();
        $transaction->setAmount($amount);
        $transaction->setDescription("Deposit Digisells Funds : ".$input['amount']." USD");

        $payment = Paypalpayment:: Payment();
        $payment->setIntent("sale");
        $payment->setPayer($payer);
        $payment->setTransactions(array($transaction));

        try {
            $payment->create($this->_apiContext);
        } catch (PayPal \ Exception \ PPConnectionException $ex) {
            return Redirect::back()->withInput()->withFlashMessage('<center><div class="alert alert-danger square">Invalid Credit Card Credentials</div></center>');
        }

        $response=$payment->toArray();
        // print_r($payment->toArray());
        $paymentId=$payment->getId();
    	//payment execution
	    $card= new Paypal;
	    $card->userID=Auth::user()->id;
	    $card->paymentID=$paymentId;
	    $card->methodID=1;
	    $card->amount = $input['amount'];
	    $card->status = 1;
	    $card->save();
	    $user = User::find(Auth::user()->id);
	    $pastfund = $user->fund;
	    DB::table('user')->where('id', '=', Auth::user()->id)
	->update(array('fund' => ($pastfund + $input['amount'])));
 return Redirect::to('/payment/'.$card->paymentID)->withFlashMessage('<center><div class="alert alert-success square">Successfully Added Funds</div></center>');

	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($paymentID)
	{
		$payment = Paypalpayment::get($paymentID,$this->_apiContext);

       // echo "<pre>";

       // dd($payment->payer->payment_method);
		return View::make('funds.showPayment',['payment'=>$payment]);
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

	public function paypal()
	{	
		$input= Input::all();
		$payer = Paypalpayment::Payer();
	    $payer->setPayment_method("paypal");

	    $amount = Paypalpayment:: Amount();
	    $amount->setCurrency("USD");
	    $amount->setTotal($input['amount']);

	    $transaction = Paypalpayment:: Transaction();
	    $transaction->setAmount($amount);
	    $transaction->setDescription("Deposit Digisells Funds : ".$input['amount']." USD");

	    $redirectUrls = Paypalpayment::RedirectUrls();
	    $redirectUrls->setReturnUrl("http://digisells.com/execute")
	            ->setCancelUrl("http://digisells.com/payment/create");

	    $payment = Paypalpayment:: Payment();
	    $payment->setIntent("sale");
	    $payment->setPayer($payer); 
	    $payment->setRedirectUrls($redirectUrls);
	    $payment->setTransactions(array($transaction));

	    try {
	        $payment->create($this->_apiContext);
	    } catch (PayPal\Exception\PPConnectionException $ex) {
	         return Redirect::back()->withInput()->withFlashMessage('<center><div class="alert alert-danger square"><b>Request Timeout!</b> Please provide 
	         	Valid Credentials or check your Internet Connections.</div></center>');

	    }
	    foreach($payment->getLinks() as $link) {
	        if($link->getRel() == 'approval_url') {
	            $redirectUrl = $link->getHref();
	            break;
	        }
	    }
	    $paypal=new Paypal;
	    $paypal->userID=Auth::user()->id;
	    $paypal->paymentID = $payment->getId();
	    $paypal->methodID = 2;
	    $paypal->amount = $input['amount'];
	    $paypal->save();
	    if(isset($redirectUrl)) {
	        header("Location: $redirectUrl");
	        exit;
	    }
	}

	public function execute() {
	$id = DB::select('Select max(id) as id from paypal where userID ='.Auth::user()->id);
	$paypal = DB::table('paypal')->where('id',$id[0]->id)->first();
	$paymentId=$paypal->paymentID;
    $payment = Paypalpayment::get($paymentId, $this->_apiContext);
    $execution = Paypalpayment::PaymentExecution();
    $execution->setPayer_id($_GET['PayerID']);
    $payment->execute($execution,$this->_apiContext);
	    
	DB::table('paypal')->where('id', '=', $id[0]->id)
	->update(array('status' => 1));

	$pastfund = Auth::user()->fund;
	$newfund = $pastfund + $paypal->amount;
	// dd($newfund);
	DB::table('user')->where('id', '=', Auth::user()->id)
	->update(array('fund' => $newfund));
    
 return Redirect::to('/payment/'.$paymentId)->withFlashMessage('<center><div class="alert alert-success square">Successfully Added Funds</div></center>');

}


}
