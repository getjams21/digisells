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
		return View::make('admin.index');
	}
	public function auctions()
	{
		if(Request::get('status') !=1){$status=0;}else{$status=1;}
		if(Request::get('expired') ==1){$expire='<=';}else{$expire='>';}
		$auctions =DB::select("select a.*,b.productName from auction as a inner join product
				as b on a.productID=b.id
				where sold=".$status." and endDate ".$expire." NOW() order by created_at desc");
		if($status==1){$body='Sold_Auctions';}else{$body='Current_Auctions';}
		if(Request::get('expired') ==1){$body ='Expired_Auctions';}
		return View::make('admin.auctions',['auctions'=>$auctions,'status'=>$status,'body'=>$body,'expired'=>Request::get('expired')]);
		// return dd($auctions);
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