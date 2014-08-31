<?php

class WatchlistController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$watchlist = DB::select("select a.*,b.username,c.productName from watchlist as a inner join
		user as b on a.userID=b.id left join product as c on a.productID=c.id where a.watcherID=".Auth::user()->id." and a.status= 1 order by created_at desc");
		if(!Input::get('page')){
		$currentPage = Input::get('page');
		}else{
		$currentPage = Input::get('page') - 1;
		}
		$pagedData = array_slice($watchlist, $currentPage *10, 10);
		$watchlist = Paginator::make($pagedData, count($watchlist), 10);
		return View::make('dashboard.watchlist',['watchlists' => $watchlist]);
		// dd($watchlist);
	}
	public function watchers()
	{
		$watchers = DB::select("select a.*,b.username,c.productName from watchlist as a inner join
		user as b on a.watcherID=b.id left join product as c on a.productID=c.id where a.userID=".Auth::user()->id." and a.status= 1 order by created_at desc");
		if(!Input::get('page')){
		$currentPage = Input::get('page');
		}else{
		$currentPage = Input::get('page') - 1;
		}
		$pagedData = array_slice($watchers, $currentPage *10, 10);
		$watchers = Paginator::make($pagedData, count($watchers), 10);
		return View::make('dashboard.watchers',['watchers' => $watchers]);
		// echo '<pre>';
		// dd($watchers);
	}

	public function watchUser()
	{
		if(Request::ajax()){
			$user=Input::all();
			$userid=$user['id'];
			$watchlist = DB::select("select * from watchlist where watcherID=".Auth::user()->id." and userID=".$userid);
			if($watchlist)
			{
				DB::table('watchlist')->where('id', '=', $watchlist[0]->id)
	->update(array('status' => 1));
  			}else{
  			$watchlist = new Watchlist;
  			$watchlist->userID=$userid;
  			$watchlist->watcherID=Auth::user()->id;
  			$watchlist->status=1;
  			$watchlist->save();
  			}

  			$thisuser = User::find($userid);
  			$watchuser = $thisuser;
			$watchuser->newNotification()
			    ->withType('UserWatched')
			    ->withSubject(Auth::user()->username)
			    ->withBody('has started watching you!')
			    ->regarding($thisuser)
			    ->deliver();
			    dd($watchuser);
  			
  		}
	
	}
	public function unwatchUser()
	{
		if(Request::ajax()){
			$user=Input::all();
			$userid=$user['id'];
			$watchlist = DB::select("select * from watchlist where watcherID=".Auth::user()->id." and userID=".$userid);
			
			DB::table('watchlist')->where('id', '=', $watchlist[0]->id)
	->update(array('status' => 0));
  			return Response::json($watchlist);
  			
  		}

	}
	public function watchProduct()
	{
  		if(Request::ajax()){
			$input=Input::all();
			$userID=$input['userID'];
			$prodID=$input['prodID'];
			$type=$input['type'];
			$watchlist = DB::select("select * from watchlist where watcherID=".Auth::user()->id." and userID=".$userID." and productID=".$prodID);
	
  			if($watchlist)
			{
				DB::table('watchlist')->where('id', '=', $watchlist[0]->id)
	->update(array('status' => 1));
  			}else{
  			$watchlist = new Watchlist;
  			$watchlist->userID=$userID;
  			$watchlist->watcherID=Auth::user()->id;
  			$watchlist->productID=$prodID;
  			$watchlist->status=1;
  			$watchlist->save();
  			}
			$thisuser = User::find($userID);
  			$watchProduct = $thisuser;
  			if($type == 1){
  				$product= Auction::where('productID', '=', $prodID)->first();
  				$watchProduct->newNotification()
			    ->withType('ProductWatched')
			    ->withSubject(Auth::user()->username)
			    ->withBody("has started watching your <a href='/auction-listing/".$product->id."'> <b>".$product->auctionName." </b></a> ")
				->regarding($product)
			    ->deliver();
	  		}else{
	  			// Direct selling watchlist here
  				$product= Selling::where('productID', '=', $prodID)->first();
  			}
  			
			  // return Response::json($product);
  			
  		}	
  	}
  	public function unwatchProduct()
	{
		if(Request::ajax()){
			$input=Input::all();
			$userID=$input['userID'];
			$prodID=$input['prodID'];
			$watchlist = DB::select("select * from watchlist where watcherID=".Auth::user()->id." and userID=".$userID." and productID=".$prodID);
			
			DB::table('watchlist')->where('id', '=', $watchlist[0]->id)
	->update(array('status' => 0));
  			return Response::json($watchlist);
  			
  		}

	}
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
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
