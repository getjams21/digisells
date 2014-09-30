<?php

class ComplaintController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /complaint
	 *
	 * @return Response
	 */
	public function index()
	{
		$complaint = DB::select('select ticket,tittle from complaints where userID='.Auth::user()->id.' group by ticket');
		return View::make('dashboard.support',['complaint'=>$complaint]);
		// return $complaint;
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /complaint/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$complaint=null;
		return View::make('dashboard.complain',['complaint'=>$complaint]);
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /complaint
	 *
	 * @return Response
	 */
	public function store()
	{
		$input= Input::all();
		$complaint = new Complaint;
		$complaint->userID = Auth::user()->id;
		$complaint->ticket = time();
		$complaint->tittle = $input['title'];
		$complaint->description = $input['description'];
		$complaint->save();
		return Redirect::to('/support');

	}

	/**
	 * Display the specified resource.
	 * GET /complaint/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($ticket)
	{
		// $complaint=DB::table('complaints')->where('ticket', '=', $ticket)->get();
		$complaint=DB::select('select a.*,b.username,b.firstName from complaints as a inner join user as b on b.id=a.userID where a.ticket = '.$ticket );
		 $title=DB::table('complaints')->where('ticket', '=', $ticket)->first();
		// echo'<pre>';
		// return dd($title);
		return View::make('dashboard.editcomplaint',['complaint'=>$complaint,'ticket'=>$ticket,'title'=> $title]);
	}
	public function editComplaint()
	{
		// $complaint=DB::table('complaints')->where('ticket', '=', $ticket)->get();
		$complaint=DB::select('select * from complaints where ticket = '.$ticket );
		 $title=DB::table('complaints')->where('ticket', '=', $ticket)->first();
		// echo'<pre>';
		// return dd($title);
		return View::make('dashboard.editcomplaint',['complaint'=>$complaint,'ticket'=>$ticket,'title'=> $title]);
	}
	public function addComplaint()
	{
		$input= Input::all();
		 $title=DB::table('complaints')->where('ticket', '=', $input['ticket'])->first();
		$complaint = new Complaint;
		$complaint->userID = Auth::user()->id;
		$complaint->ticket = $input['ticket'];
		$complaint->tittle = $title->tittle;
		$complaint->description = $input['description'];
		$complaint->save();
		return Redirect::back();
		
	}
	/**
	 * Show the form for editing the specified resource.
	 * GET /complaint/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($ticket)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /complaint/{id}
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
	 * DELETE /complaint/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}