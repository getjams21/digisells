<?php
use Carbon\Carbon;
class DashboardController extends \BaseController {

	public function __construct() {
	}
	/**
	 * Display a listing of the resource.
	 * GET /dashboard
	 *
	 * @return Response
	 */
	public function index()
	{
		$user = User::find(Auth::user()->id);
		$notifications = $user->notifications()->orderBy('created_at','desc')->take(20)->get()->toArray();
		return View::make('dashboard.index',['notifications' => $notifications]);
	}
	public function auctionList()
	{
		if(Request::get('status')){
			if(Request::get('status') =='expired'){$expired='<=';}else{$expired='>';}
		}else{$expired='>';}
		$auction=DB::select("select a.*,(select count(id) from bidding where auctionID=a.id and amount>0 and userID!=".Auth::user()->id.") 
				as bidders,e.username,e.firstName as maxBidder,d.created_at as datebid,d.amount as maxBid 
				from auction as a inner join product as b on a.productID=b.id left join (select max(amount) 
				as amount,auctionID from bidding where userID!=".Auth::user()->id." group by auctionID) as c on a.id=c.auctionID 
				left join bidding as d on d.amount=c.amount left join user as e on d.userID=e.id where b.userID=".Auth::user()->id." 
				and a.sold=0 and a.endDate ".$expired." NOW() order by created_at desc");
		// echo '<pre>';
		// return dd($auction);
		return View::make('dashboard.auctionList',['auction' => $auction,'status'=>Request::get('status')]);
	}
	public function directSellingList()
	{
		if(Request::get('status')){
			if(Request::get('status') =='expired'){$expired='<=';}else{$expired='>';}
		}else{$expired='>';}
		$selling=DB::select('select a.*,c.count from selling as a inner join product as b on a.productID=b.id 
				left join (select count(sellingID) as count,sellingID from sales group by sellingID) as c on a.id=c.sellingID 
				where b.userID='.Auth::user()->id." and a.expirationDate ".$expired." NOW() order by created_at desc");
		// echo '<pre>';
		// return dd($selling);
		return View::make('dashboard.directSellingList',['selling' => $selling,'status'=>Request::get('status')]);
	}
	public function invoices()
	{
		$auctionInvoice = DB::select('
			select s.*,p.id as productID,p.productName,p.downloadLink,
			(select id from reviews where userID = '.Auth::user()->id.' and productID = p.id) as reviewID
			from sales as s
			inner join auction as a on s.auctionID = a.id
			inner join product as p on a.productID = p.id
			where buyerID = '.Auth::user()->id.'
			');
		$sellingInvoice = DB::select('
			select s.*,p.id as productID,p.productName,p.downloadLink,
			(select id from reviews where userID = '.Auth::user()->id.' and productID = p.id) as reviewID
			from sales as s
			inner join selling as se on s.sellingID = se.id
			inner join product as p on se.productID = p.id
			where buyerID = '.Auth::user()->id.'
			');
		// dd($sellingInvoice);
		// $reviewed = DB::select('select id from reviews where userID = '.Auth::user()->id.'')
			return View::make('dashboard.invoices', compact('auctionInvoice','sellingInvoice'));
			// return $sellingInvoice;
	}
	public function activebids()
	{
		$activebids = DB::select('select a.*,b.productName,c.maxBid,c.amount,c.userID, 
				c.created_at as date from auction as a inner join product as b on a.productID=b.id inner 
				join bidding as c on c.auctionID=a.id inner join (select max(amount) 
				as max, auctionID from bidding group by auctionID) as temp on 
				temp.max=c.amount where a.sold=0 and c.userID='.Auth::user()->id);
		return View::make('dashboard.activebids',['activebids'=>$activebids]);
	}
	public function inactivebids()
	{
		$inactivebids = DB::select('select a.*,b.userID as seller,c.amount,c.userID,(select max(amount) from bidding where auctionID=a.id)
			as maxBid from auction as a inner join product as b on a.productID=b.id inner join (select a.id,(select userID from bidding 
			where amount=(select max(amount) from bidding where auctionID=a.id) and auctionID=a.id)
			as maxuser,(select max(amount) from bidding where auctionID=a.id and userID!=maxuser
			and userID='.Auth::user()->id.') as second from auction as a) as d on a.id=d.id inner 
			join bidding as c on c.auctionID=a.id and c.amount=d.second where c.userID='.Auth::user()->id.'
			 and amount!=0 and b.userID!='.Auth::user()->id);
		// echo '<pre>';
		// return dd($inactivebids);
		return View::make('dashboard.inactivebids',['inactivebids'=>$inactivebids]);
	}
	public function readNotif(){
		if(Request::ajax()){
			$notif=Input::all();
			$notifid=$notif['id'];
			DB::table('notifications')->where('id', '=', $notifid)
	->update(array('is_read' => 1));
		$user = User::find(Auth::user()->id);
		$notifications = $user->notifications()->unread()->count();
		return Response::json($notifications);
  			
  		}
	
	}
	public function soldAuctions()
	{
		$soldAuctions= DB::select("select a.*,b.affiliatePercentage,e.username as affUsername,e.firstName as affFirstName,
			b.auctionName,b.minimumPrice,b.buyoutPrice,d.username,d.firstName,
		 (select count(id) from bidding where auctionID=a.auctionID and amount>0 and userID!=".Auth::user()->id.") as bidders
		  from sales as a inner join auction as b on a.auctionID=b.id inner join product as c on b.productID=c.id 
		  inner join user as d on a.buyerID=d.id left join affiliates as f on f.id=a.affiliateID left join (select * from user) as e on e.id=f.userID
		  where a.auctionID IS NOT NULL and c.userID =".Auth::user()->id);
		// echo '<pre>';
		// return dd($soldAuctions);
		return View::make('dashboard.soldAuctions',['soldAuctions'=>$soldAuctions]);
	}
	public function soldDirectSelling()
	{
		$soldSelling= DB::select('select a.sellingID,b.affiliatePercentage,(select count(id) from sales where 
			sellingID=a.sellingID and affiliateID IS NOT NULL) as affiliates,b.sellingName,b.price,b.discount,count(a.sellingID) as buyers,b.expirationDate as endDate
			,a.amount ,d.firstName as seller from sales as a inner join selling as b on a.sellingID=b.id inner join
			 product as c on b.productID=c.id inner join user as d on c.userID=d.id where a.sellingID 
			 IS NOT NULL and d.id='.Auth::user()->id.' group by a.sellingID');
		return View::make('dashboard.soldSelling',['soldSelling'=>$soldSelling]);
	}
	public function fetchSalesDetails()
	{
		if(Request::ajax()){
			$selling=Input::all();
			$sellingID=$selling['sellingID'];
			$details = DB::select("select a.transactionNO,a.amount,a.created_at,b.firstName,b.username from sales as a inner join user as b on a.buyerID=b.id where sellingID = ".$sellingID."
								 order by a.created_at desc");
			
  			return Response::json($details);
  			
  		}
	}
	public function affiliations()
	{
		$affiliations= DB::select('select a.*,count(b.id) as affCount,c.sellingName,b.amount as amountSold,c.price as sellingPrice,
			c.discount as sellingDiscount,c.affiliatePercentage as sellingAffPerc ,d.auctionName,d.minimumPrice,
			d.buyoutPrice,d.affiliatePercentage as auctionAffPerc,e.username,e.firstName from affiliates as a left join sales as b on a.id=b.affiliateID
			 and (a.auctionID=b.auctionID or a.sellingID=b.sellingID) left join selling as c
			  on c.id=a.sellingID left join auction as d on d.id=a.auctionID left join user as e on e.id=b.buyerID 
			 where a.userID ='.Auth::user()->id.' group by a.id');
		return View::make('dashboard.affiliations',['affiliations'=>$affiliations]);
		// echo '<pre>';
		// return dd($affiliations);
	}
	public function credits()
	{
		$credits= DB::select('select a.*,b.amount,b.sellingID,b.auctionID,c.sellingName,d.auctionName from credits as a 
			inner join sales as b on b.id=a.salesID left join selling as c on c.id=b.sellingID 
		left join auction as d on d.id=b.auctionID 
		 where a.userID='.Auth::user()->id);
		return View::make('dashboard.credits',['credits'=>$credits]);
		// echo '<pre>';
		// return dd($credits);
	}
	// 
	
	/**
	 * Show the form for creating a new resource.
	 * GET /dashboard/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /dashboard
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /dashboard/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return 'show';
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /dashboard/{id}/edit
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
	 * PUT /dashboard/{id}
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
	 * DELETE /dashboard/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}