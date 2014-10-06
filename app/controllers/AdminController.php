<?php
use PayPal\Types\Common\RequestEnvelope;
use PayPal\Service\AdaptivePaymentsService;
use PayPal\Types\AP\PaymentDetailsRequest;

class AdminController extends \BaseController {
	private $_apiContext;
	private $paypal;
    private $_ClientId='AaexIxC3q4yf1Fj65Mg0e7fxjCSYjBw0rUwRuiXuBxwIan0Biqb1QtHbFav-';
    private $_ClientSecret='EBDU3RAmr8mtH9J-KP027YM2rLbUN_vKOtWFMVvIBwpEvFWBV0T2pCIwQ91b';
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
		$daily=DB::select('select DATE(created_at) as date,count(amount) as count,sum(amount) as amount from sales where created_at between date_sub(now(),INTERVAL 1 WEEK) and now() GROUP BY DATE(created_at)');
		$dates= array();
		$amounts = array();
		$i=0;
		foreach($daily as $dailies){
			$dates[$i] = $dailies->date;
			$amounts[$i] = $dailies->amount;
			$amounts[$i] = $dailies->amount;
			$i++;
		};
		return View::make('admin.index',['new'=>$new,'dates'=>$dates,'amounts'=>$amounts,'dailies'=>$daily]);
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
		  inner join user as d on a.buyerID=d.id left join affiliates as f on f.id=a.affiliateID left join (select * from user)
		  as e on e.id=f.userID where a.auctionID IS NOT NULL ");
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
	public function affiliations()
	{ 
		$affiliations= DB::select('select a.*,(select count(id) from sales where affiliateID=a.id) as affCount
			,c.sellingName,b.amount as amountSold,c.price as sellingPrice, c.discount as sellingDiscount
			,c.affiliatePercentage as sellingAffPerc ,d.auctionName,d.minimumPrice, d.buyoutPrice,
			d.affiliatePercentage as auctionAffPerc,e.username,e.firstName from affiliates as a inner join
			 sales as b on a.id=b.affiliateID and (a.auctionID=b.auctionID or a.sellingID=b.sellingID) left
			  join selling as c on c.id=a.sellingID left join auction as d on d.id=a.auctionID left join user
			   as e on e.id=a.userID 
			 ');
		return View::make('admin.affiliations',['affiliations'=>$affiliations ]);
	}
	public function credits()
	{ 
		$credits= DB::select('select a.*,b.amount,b.sellingID,b.auctionID,c.sellingName,d.auctionName
			,e.username,e.firstName from credits as a 
			inner join sales as b on b.id=a.salesID inner join user as e on e.id=a.userID
			left join selling as c on c.id=b.sellingID 
			left join auction as d on d.id=b.auctionID ');
		//echo '<pre>';
		//return dd($credits);
		return View::make('admin.credits',['credits'=>$credits ]);
	}
	public function complaints()
	{ 
		$complaints = DB::select('select a.* ,(select count(id) from complaintdetails where complaintID=a.id and senderID!= a.userID )
		as replies,(select username from user where id=(select senderID from complaintdetails where id=b.id)) as username,
		(select firstName from user where id=(select senderID from complaintdetails where id=b.id)) as firstName from complaints as a 
		left join (select max(id) as id,complaintID from complaintdetails group by complaintID) as b on a.id=b.complaintID ');
		// echo '<pre>';
		// return dd($complaints);
		return View::make('admin.complaints',['complaint'=>$complaints ]);
	}
	public function editcomplaints($ticket)
	{ 
		$complaint=DB::select('select a.*,b.username,b.firstName from complaints as a inner join user as b on b.id=a.userID 
								where a.ticket = '.$ticket);
		 $details = DB::select('select a.*,b.username,b.firstName from complaintdetails as a inner join user as b on b.id=a.senderID 
		 		 where a.complaintID = '.$complaint[0]->id.' order by a.created_at desc');
		return View::make('admin.editcomplaint',['complaint'=>$complaint,'details'=>$details]);
	}
	public function summary()
	{ 
		
		$deposits=DB::select('Select count(amount) as count, sum(amount) as amount from deposit where status=1') ;
		$withdrawals=DB::select('Select count(amount) as count, sum(amount) as amount from withdrawals where status=1') ;
		$userfunds=DB::select('Select sum(fund) as funds from user');
		$usercredits=DB::select('Select sum(creditAdded)-sum(creditDeducted) as credits from credits');
		$auctionSales=DB::select("select count(amount) as count,sum(amount) as amount from sales where auctionID IS NOT NULL");
		$sellingSales= DB::select('select count(amount) as count,sum(amount) as amount from sales where sellingID IS NOT NULL');
		$daily=DB::select('select DATE(created_at) as date,count(amount) as count,sum(amount) as amount from sales where created_at between date_sub(now(),INTERVAL 1 WEEK) and now() GROUP BY DATE(created_at)');
		$dates= array();
		$amounts = array();
		$i=0;
		// echo '<pre>';
		// return dd($daily);
		foreach($daily as $dailies){
			$dates[$i] = $dailies->date;
			$amounts[$i] = $dailies->amount;
			$amounts[$i] = $dailies->amount;
			$i++;
		};
		return View::make('admin.summary',['deposits'=>$deposits,'withdrawals'=>$withdrawals,'userfunds'=>$userfunds,'dailies'=>$daily,
											'usercredits'=>$usercredits,'auctionSales'=>$auctionSales,'sellingSales'=>$sellingSales,'dates'=>$dates,'amounts'=>$amounts ]);
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
							on b.id=a.methodID inner join user as c on a.userID=c.id where a.status=1');
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