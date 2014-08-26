<?php

class FundsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$user= Auth::user()->id;
		$fund =DB::select("select b.methodName,c.* from funds as a inner join method as b on a.methodID=b.id inner join paypal as c on a.id=c.fundID where a.userID=".$user." and b.id = 1 or b.id=2 order by c.created_at desc");
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
		// return View::make('funds.add');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
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


}
