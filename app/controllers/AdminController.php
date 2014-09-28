<?php
use PayPal\Types\Common\RequestEnvelope;
use PayPal\Service\AdaptivePaymentsService;
use PayPal\Types\AP\PaymentDetailsRequest;

class AdminController extends \BaseController {
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
	 * GET /admin
	 *
	 * @return Response
	 */
	public function index()
	{
		$newusers = DB::select('select count(id) as count from user where created_at between date_sub(now(),INTERVAL 1 WEEK) and now()');
		$newauction= DB::select('select count(id) as count from auction where created_at between date_sub(now(),INTERVAL 1 WEEK) and now()');
		$selling=DB::select('select count(id) as count from selling where created_at between date_sub(now(),INTERVAL 1 WEEK) and now()');
		$deposits=DB::select('select count(id) as count from deposit where created_at between date_sub(now(),INTERVAL 1 WEEK) and now()');
		$withdrawals=DB::select('select count(id) as count from withdrawals where created_at between date_sub(now(),INTERVAL 1 WEEK) and now()');
		$listings=$newauction[0]->count + $selling[0]->count;
		$new= array('users'=>$newusers[0]->count,'listings'=>$listings,
			'deposits'=>$deposits[0]->count,'withdrawals'=>$withdrawals[0]->count);
		return dd($newusers);
		// return View::make('admin.index',['new'=>$new]);
	}
	public function auctions()
	{ 
		if(Request::get('expired') ==1){$expire='<=';}else{$expire='>';}
		$auctions =DB::select("select a.*,(select count(id) from bidding where auctionID=a.id and amount>0 and userID!=b.userID) 
				as bidders,e.username,(select username from user where id=b.userID) as sellerUsername,
				(select firstname from user where id=b.userID) as seller,e.firstName as maxBidder,d.created_at as datebid,
				d.amount as maxBid from auction as a inner join product as b on a.productID=b.id left join (select max(amount) 
				as amount,auctionID from bidding group by auctionID) as c on a.id=c.auctionID
				left join bidding as d on d.amount=c.amount left join user as e on d.userID=e.id and e.id!= b.userID
				where a.sold=0 and a.endDate ".$expire." NOW() order by created_at desc");
		return View::make('admin.auctions',['auctions'=>$auctions,'expired'=>Request::get('expired')]);
		// return dd($auctions);
	}
	public function selling()
	{ 
		if(Request::get('expired') ==1){$expire='<=';}else{$expire='>';}
		$selling=DB::select("select a.*,d.username as sellerUsername,d.firstName as seller, c.count from selling as a inner join product as b on a.productID=b.id 
				left join (select count(sellingID) as count,sellingID from sales group by sellingID) as c on a.id=c.sellingID 
				left join user as d on d.id=b.userID where a.expirationDate ".$expire." NOW() order by created_at desc");
		return View::make('admin.selling',['selling'=>$selling,'expired'=>Request::get('expired')]);
		// return dd($auctions);
	}
	public function bidding()
	{ 
		$bidding=DB::select('select a.*,b.productName,c.maxBid,c.amount,c.userID,d.username as bidderUsername,
				d.firstName as maxBidder, c.created_at as date from auction as a inner join product as b 
				on a.productID=b.id inner join bidding as c on c.auctionID=a.id inner join (select max(amount) 
				as max, auctionID from bidding group by auctionID) as temp on 
				temp.max=c.amount left join user as d on d.id=c.userID where a.sold=0 ');
		return View::make('admin.bidding',['bidding'=>$bidding ]);
		// return dd($auctions);
	}
	public function auctionSales()
	{ 
		$auctionSales=DB::select("select a.*,(select username from user where id=c.userID) as sellerUsername
			,(select firstName from user where id=c.userID) as sellerFirstname,e.username as affUsername,e.firstName 
			as affFirstname,b.auctionName,b.affiliatePercentage as affiliatePercentage
			,b.minimumPrice,b.buyoutPrice,d.username,d.firstName,e.username as affUsername,e.firstName as affFirstName,
			 (select count(id) from bidding where auctionID=a.auctionID and amount>0 and userID!=c.userID) as bidders
		  from sales as a inner join auction as b on a.auctionID=b.id inner join product as c on b.productID=c.id 
		  inner join user as d on a.buyerID=d.id left join (select * from user) as e on e.id=a.affiliateID where a.auctionID IS NOT NULL ");
		return View::make('admin.auctionSales',['auctionSales'=>$auctionSales ]);
	}
	public function sellingSales()
	{ 
		$sellingSales= DB::select('select a.sellingID,(select count(id) from sales where sellingID=a.sellingID and affiliateID IS NOT NULL) 
			as affiliates ,b.sellingName,b.affiliatePercentage,b.price,b.discount,count(a.sellingID) as buyers,b.expirationDate as endDate
			,a.amount ,d.firstName as sellerFirstname,d.username as sellerUsername from sales as a inner join selling as b on a.sellingID=b.id inner join
			 product as c on b.productID=c.id inner join user as d on c.userID=d.id where a.sellingID 
			 IS NOT NULL group by a.sellingID');
		return View::make('admin.sellingSales',['sellingSales'=>$sellingSales ]);
	}
	public function categories()
	{
		$categories = DB::select('Select * from Category order by status desc');
		$default = DB::select('Select id from Category order by status desc limit 1');
		$subcategories = DB::select('Select * from subcategory where categoryID='.$default[0]->id." order by status desc");
		return View::make('admin.categories',['categories'=>$categories,'subcategories'=>$subcategories,'default'=>$default[0]->id]);
	}
	public function fetchSubCategory(){
		if(Request::ajax()){
  			$input = Input::all();
  			$val = $input['val'];
  			$subCategories = DB::select('Select id,name,description,status from subcategory where categoryID ='.$val);
			return Response::json($subCategories);
  		}
	}
	public function getdetails(){
		if(Request::ajax()){
  			$input = Input::all();
  			$val = $input['val'];
  			$type = $input['type'];
  			if($type=='category'){$name='categoryName';}else{$name='name';}
  			$details = DB::select('Select '.$name.',description,status from '.$type.' where id ='.$val);
			return Response::json($details);
  		}
	}
	public function editCategory(){
		if(Request::ajax()){
  			$input = Input::all();
  			$id = $input['id'];
  			$type = $input['type'];
  			$Catname = $input['name'];
  			$desc = $input['desc'];
  			$status = $input['status'];
  			if($type=='category'){$name='categoryName';}else{$name='name';}
		  	DB::table($type)->where('id', '=', $id)
			->update(array($name => $Catname,'description' =>$desc ,'status'=>$status ));
		}
	}
	public function addCategory(){
		if(Request::ajax()){
  			$input = Input::all();
  			$type = $input['type'];
  			$Catname = $input['name'];
  			$desc = $input['desc'];
  			$catNO = $input['catNO'];
  			if($type=='category'){
				$category = New Category;
				$category->categoryName=$Catname;
				$category->description=$desc;
				$category->save();
			}else{
				$category = New Subcategory;
				$category->categoryID=$catNO;
				$category->name=$Catname;
				$category->description=$desc;
				$category->save();
			}
  			return Response::json($category);
  		}
	}
	public function deposits(){
		$deposits=DB::select('Select a.*,b.methodName,c.username from deposit as a inner join method as b
							on b.id=a.methodID inner join user as c on a.userID=c.id');
		return View::make('admin.fundDeposits',['deposits'=>$deposits]);
	}
	public function withdrawals(){
		$withdrawals=DB::select('Select a.*,b.username from withdrawals as a inner join user as b
							on a.userID=b.id');
		return View::make('admin.fundWithdrawals',['withdrawals'=>$withdrawals]);
	}
	public function showDeposit($paymentID)
	{
		try {
			$payment = Paypalpayment::get($paymentID,$this->_apiContext);
	    } catch (PayPal\Exception\PPConnectionException $ex) {
	         return Redirect::back()->withFlashMessage('<center><div class="alert alert-danger square"><b>Request Timeout!</b> Please check your Internet Connections.</div></center>');
		 }
		return View::make('admin.fundDepositInvoice',['payment'=>$payment]);
	}
	public function showWithdrawal($payKey)
	{
		// return 'hello';
		$sdkConfig = array(
			"mode" => "sandbox",
			"acct1.UserName" => "admin_api1.digisells.com",
			"acct1.Password" => "1408017508",
			"acct1.Signature" => "AeCea6xAGs-n.GkSEXGeWXluuTzOAQSphFYGiGoMTvunIwAhl6PAZu1P",
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
		$date = DB::table('withdrawals')->where('paykey', '=', $payKey)->get();
		return View::make('admin.fundWithdrawalInvoice',['withdrawal'=>$paymentDetailsResponse,'date'=>$date]);
	}
	

	/**
	 * Show the form for creating a new resource.
	 * GET /admin/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /admin
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /admin/{id}
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
	 * GET /admin/{id}/edit
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
	 * PUT /admin/{id}
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
	 * DELETE /admin/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}