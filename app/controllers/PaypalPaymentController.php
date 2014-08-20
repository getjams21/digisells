<?php

class PaypalPaymentController extends \BaseController {
	 /**
     * object to authenticate the call.
     * @param object $_apiContext
     */
    private $_apiContext;
    private $_ClientId='ATp6uBApduUYkCLe5iOKhD7lQhfc8kdmKc2dvtlLaCfiYDmmolDMoAu2vwAJ';
    private $_ClientSecret='ENvUWRCSJf06XpAdKaiNtVLAMpB4uvupciqloNExUyQYK13ZRbQ78BcupVst';

	    public function __construct()
	    {
            
	        // ### Api Context
	        // Pass in a `ApiContext` object to authenticate 
	        // the call. You can also send a unique request id 
	        // (that ensures idempotency). The SDK generates
	        // a request id if you do not pass one explicitly. 

    		$this->_apiContext = Paypalpayment::ApiContext(
            Paypalpayment::OAuthTokenCredential(
                $this->_ClientId,
                $this->_ClientSecret
            )
        );
	        // dynamic configuration instead of using sdk_config.ini

	        // $this->_apiContext->setConfig(array(
	        //     'mode' => 'sandbox',
	        //     'http.ConnectionTimeOut' => 30,
	        //     'log.LogEnabled' => true,
	        //     'log.FileName' => __DIR__.'/../PayPal.log',
	        //     'log.LogLevel' => 'FINE'
	        // ));

	    }
	/**
	 * Display a listing of the resource.
	 * GET /paypalpayment
	 *
	 * @return Response
	 */
	public function index()
	{
		 echo "<pre>";

        $payments = Paypalpayment::all(array('count' => 1, 'start_index' => 0),$this->_apiContext);

        print_r($payments);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /paypalpayment/create
	 *
	 * @return Response
	 */
	public function create()
	{
		 // ### Address
        // Base Address object used as shipping or billing
        // address in a payment. [Optional]
        // $addr= Paypalpayment::Address();
        // $addr->setLine1("3909 Witmer Road");
        // $addr->setLine2("Niagara Falls");
        // $addr->setCity("Niagara Falls");
        // $addr->setState("NY");
        // $addr->setPostal_code("14305");
        // $addr->setCountry_code("US");
        // $addr->setPhone("716-298-1822");

        // ### CreditCard
        // A resource representing a credit card that can be
        // used to fund a payment.
        $card = Paypalpayment::CreditCard();
        $card->setType("visa");
        $card->setNumber("4417119669820331");
        $card->setExpire_month("11");
        $card->setExpire_year("2019");
        $card->setCvv2("012");
        $card->setFirst_name("Anouar");
        $card->setLast_name("Abdessalam");
        // $card->setBilling_address($addr);

        // ### FundingInstrument
        // A resource representing a Payer's funding instrument.
        // Use a Payer ID (A unique identifier of the payer generated
        // and provided by the facilitator. This is required when
        // creating or using a tokenized funding instrument)
        // and the `CreditCardDetails`
        $fi = Paypalpayment::FundingInstrument();
        $fi->setCredit_card($card);

        // ### Payer
        // A resource representing a Payer that funds a payment
        // Use the List of `FundingInstrument` and the Payment Method
        // as 'credit_card'
        $payer = Paypalpayment::Payer();
        $payer->setPayment_method("credit_card");
        $payer->setFunding_instruments(array($fi));

        // ### Amount
        // Let's you specify a payment amount.
        $amount = Paypalpayment:: Amount();
        $amount->setCurrency("USD");
        $amount->setTotal("2.00");

        // ### Transaction
        // A transaction defines the contract of a
        // payment - what is the payment for and who
        // is fulfilling it. Transaction is created with
        // a `Payee` and `Amount` types
        $transaction = Paypalpayment:: Transaction();
        $transaction->setAmount($amount);
        $transaction->setDescription("This is the payment description.");

        // ### Payment
        // A Payment Resource; create one using
        // the above types and intent as 'sale'
        $payment = Paypalpayment:: Payment();
        $payment->setIntent("sale");
        $payment->setPayer($payer);
        $payment->setTransactions(array($transaction));

        // ### Create Payment
        // Create a payment by posting to the APIService
        // using a valid ApiContext
        // The return object contains the status;
        try {
            $payment->create($this->_apiContext);
        } catch (\PPConnectionException $ex) {
            return "Exception: " . $ex->getMessage() . PHP_EOL;
            var_dump($ex->getData());
            exit(1);
        }

        $response=$payment->toArray();

        echo"<pre>";
        // print_r($response);

        // var_dump($payment->getId());

        print_r($payment->toArray());//$payment->toJson();
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /paypalpayment
	 *
	 * @return Response
	 */
	public function store()
	{
		// Get the payment Object by passing paymentId
    // payment id and payer ID was previously stored in database in
    // create() fuction , this function create payment using "paypal" method
    $paymentId = '';
    $PayerID = '';
    $payment = Paypalpayment::get($paymentId, $this->_apiContext);

    // PaymentExecution object includes information necessary 
    // to execute a PayPal account payment. 
    // The payer_id is added to the request query parameters
    // when the user is redirected from paypal back to your site
    $execution = Paypalpayment::PaymentExecution();
    $execution->setPayer_id($PayerID);

    //Execute the payment
    $payment->execute($execution,$this->_apiContext);
	}

	/**
	 * Display the specified resource.
	 * GET /paypalpayment/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	 public function show($payment_id)
    {
       $payment = Paypalpayment::get($payment_id,$this->_apiContext);

       echo "<pre>";

       print_r($payment);
    }

	/**
	 * Show the form for editing the specified resource.
	 * GET /paypalpayment/{id}/edit
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
	 * PUT /paypalpayment/{id}
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
	 * DELETE /paypalpayment/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}