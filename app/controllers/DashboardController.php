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
		$id= Auth::user()->id;
		$user = User::find($id);
		$notifications = $user->notifications()->orderBy('created_at','desc')->remember(60)->get()->toArray();
		if(!Input::get('page')){
		$currentPage = Input::get('page');
		}else{
		$currentPage = Input::get('page') - 1;
		}
		$pagedData = array_slice($notifications, $currentPage *10, 10);
		$notifications = Paginator::make($pagedData, count($notifications), 10);
		return View::make('dashboard.index',['notifications' => $notifications]);
	}
	public function auctionList(){
		$user= Auth::user()->id;
		$auction=DB::select('select a.*,b.userID,b.quantity from auction as a inner join product as b on a.productID=b.id where b.userID='.$user." order by created_at desc");
		return View::make('dashboard.auctionList',['auction' => $auction]);
	}
	public function directSellingList()
	{
		$user= Auth::user()->id;
		$selling=DB::select('select a.*,b.userID,b.quantity from selling as a inner join product as b on a.productID=b.id where b.userID='.$user." order by created_at desc");
		return View::make('dashboard.directSellingList',['selling' => $selling]);
		// dd($selling);
	}
	public function invoices()
	{
		return View::make('dashboard.invoices');
	}
	public function wonbids()
	{
		return View::make('dashboard.wonbids');
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