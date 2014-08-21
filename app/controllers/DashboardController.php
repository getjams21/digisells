<?php
use Carbon\Carbon;
class DashboardController extends \BaseController {

	public function __construct() {
    $this->beforeFilter('csrf', array('on'=>'post'));
	}
	/**
	 * Display a listing of the resource.
	 * GET /dashboard
	 *
	 * @return Response
	 */
	public function index()
	{
		$user= Auth::user()->id;
		$fund =DB::select('select a.*,b.methodDesc from funds as a inner join method as b on a.methodID=b.id where a.userID='.$user." order by created_at desc");
		$counter=1;
		return View::make('dashboard.index',['fund' => $fund,'counter'=>$counter]);
	}
	public function invoices()
	{
		return View::make('dashboard.invoices');
	}
	public function bids()
	{
		return View::make('dashboard.bids');
	}
	public function watchlist()
	{
		return View::make('dashboard.watchlist');
	}
	public function listings()
	{
		$user= Auth::user()->id;
		$selling=DB::select('select a.*,b.userID,b.quantity from selling as a inner join product as b on a.productID=b.id where b.userID='.$user." order by created_at desc");
		$auction=DB::select('select a.*,b.userID,b.quantity from auction as a inner join product as b on a.productID=b.id where b.userID='.$user." order by created_at desc");
		$counter=1;
		$a = $auction[0];
		return View::make('dashboard.listings',['selling' => $selling,'auction' => $auction,'counter'=>$counter]);
		// dd($selling);
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