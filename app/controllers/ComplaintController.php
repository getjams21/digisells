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
		$complaint = DB::select('select a.*,(select count(id) from complaintdetails where complaintID=a.id and senderID!='.Auth::user()->id.')
		as replies,b.senderID from complaints as a left join (select senderID,complaintID from complaintdetails order by created_at desc  limit 1)
		 as b on a.id=b.complaintID where userID='.Auth::user()->id.' group by ticket');
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
		return View::make('dashboard.complain');
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
		$complaint->title = $input['title'];
		$complaint->priority = $input['priority'];
		$complaint->category = $input['category'];
		if(Input::hasFile('screenshot'))
			{
				$file = Input::file('screenshot');
				$fileName = Str::random(20) . '.' . Input::file('screenshot')->getClientOriginalExtension();
				// return $fileName;
				$fileSize = Input::file('screenshot')->getSize();
				
				// file should be an image
				$validator = Validator::make(
					array('screenshot'=> $file),
					array('screenshot' =>'image|max:2000000|mimes:jpg,jpeg,bmp,png')
					);
				if($validator->fails()){
					return Redirect::back()->withInput()->withErrors($validator, 'screenshot');
				}else{	
					if($fileSize>2000000){
				return Redirect::back()->withInput()->withFlashMessage('<center><div class="alert alert-danger square">Image must be less than 2mb</div></center>');
					}else{
					$file->move(screenshot_photos_path(),$fileName);
					$complaint->screenshot = $fileName;
					}
				}
			}
		$complaint->save();
		$complaintdetails = new Complaintdetails;
		$complaintdetails->complaintID=$complaint->id;
		$complaintdetails->senderID=Auth::user()->id;
		$complaintdetails->description=$input['description'];
		$complaintdetails->save();
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
		 $complaint=DB::select('select a.*,b.username,b.firstName from complaints as a inner join user as b on b.id=a.userID 
								where a.ticket = '.$ticket);
		 $details = DB::select('select a.*,b.username,b.firstName from complaintdetails as a inner join user as b on b.id=a.senderID 
		 		 where a.complaintID = '.$complaint[0]->id.' order by a.created_at desc');
		return View::make('dashboard.editcomplaint',['complaint'=>$complaint,'details' => $details]);
	}
	public function solveRequest($ticket)
	{
		$complaint=DB::table('complaints')->where('ticket', '=', $ticket)->first();
		 DB::table('complaints')->where('ticket', '=', $ticket)
	->update(array('solved' => 1));
	return Redirect::back()->withFlashMessage("<div class='alert alert-success'> Successfully changes status!. </div>");
	}
	public function addComplaint($ticket)
	{
		$input= Input::all();
		$complaint=DB::table('complaints')->where('ticket', '=', $ticket)->first();
	
		$complaintdetails = new Complaintdetails;
		$complaintdetails->complaintID = $complaint->id;
		$complaintdetails->senderID = Auth::user()->id;
		$complaintdetails->description = $input['description'];
		$complaintdetails->save();
		return Redirect::back()->withFlashMessage('<div class="alert alert-success">Successfuly Sent Ticket Response. </div>');
		
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