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
		$notifications = $user->notifications()->orderBy('created_at','desc')->take(200)->get()->toArray();
		return View::make('dashboard.index',['notifications' => $notifications]);
	}
	public function auctionList()
	{
		$auction=DB::select('select a.*,b.userID,b.quantity from auction as a inner join product as b on a.productID=b.id where b.userID='.Auth::user()->id." order by created_at desc");
		return View::make('dashboard.auctionList',['auction' => $auction]);
	}
	public function directSellingList()
	{
		$selling=DB::select('select a.*,b.userID,b.quantity from selling as a inner join product as b on a.productID=b.id where b.userID='.Auth::user()->id." order by created_at desc");
		return View::make('dashboard.directSellingList',['selling' => $selling]);
	}
	public function invoices()
	{
		$auctionInvoice = DB::select('
			select s.*,p.productName from sales as s
			inner join auction as a on s.auctionID = a.id
			inner join product as p on a.productID = p.id
			where buyerID = '.Auth::user()->id.'
			');
		$sellingInvoice = DB::select('
			select s.*,p.productName from sales as s
			inner join selling as se on s.sellingID = se.id
			inner join product as p on se.productID = p.id
			where buyerID = '.Auth::user()->id.'
			');
		if($auctionInvoice || $sellingInvoice){
			// dd($auctionInvoice);
			return View::make('dashboard.invoices', compact('auctionInvoice','sellingInvoice'));
		}else{
			return View::make('dashboard.invoices')
								->withFlashMessage('
									<div class="alert alert-danger square error-bid" role="alert">
										Ohh Snap!..You do not have Invoices yet!
									</div>
								');
		}
	}
	public function activebids()
	{
		$activebids = DB::select('select a.*,b.productName,c.maxBid,c.amount,c.userID, 
				c.created_at as date from auction as a inner join product as b on a.productID=b.id inner 
				join bidding as c on c.auctionID=a.id inner join (select max(amount) 
				as max, auctionID from bidding group by auctionID) as temp on 
				temp.max=c.amount where c.userID='.Auth::user()->id);
		return View::make('dashboard.activebids',['activebids'=>$activebids]);
	}
	public function inactivebids()
	{
		return View::make('dashboard.inactivebids');
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