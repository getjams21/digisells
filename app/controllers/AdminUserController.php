<?php

class AdminUserController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /adminuser
	 *
	 * @return Response
	 */
	public function index(){
		//
	}

	public function users(){
		if(Request::get('status') !=1){$status=0;}else{$status=1;}
		$users =DB::select("select a.*,b.role from user as a inner join 
			(select a.user_id, GROUP_CONCAT(b.name SEPARATOR ', ') 
				as role FROM role_user as a inner join roles as b 
				on a.role_id=b.id group by a.user_id) as b on a.id=b.user_id 
				where status=".$status." order by created_at asc");
		if($status==1){$body='Active_Accounts';}else{$body='Inactive_Accounts';}
		return View::make('admin.users',['users'=>$users,'status'=>$status,'body'=>$body]);
	}
	public function getroles(){
		if(Request::ajax()){
  			$input = Input::all();
  			$id = $input['id'];
  			$roles= DB::select('Select role_id from role_user where user_id ='.$id);
			return Response::json($roles);
  		}
	}
	public function editroles(){
		if(Request::ajax()){
  			$input = Input::all();
  			$id = $input['id'];
  			$admin = $input['admin'];
  			$owner = $input['owner'];
  			$user = User::whereId($id)->first();
  			if($admin==1){
			  if(!$user->hasRole('admin')){$user->assignRole(2);}
			}else if($admin==0){
			  if($user->hasRole('admin')){$user->removeRole(2);}
			}
			if($owner==1){
			  if(!$user->hasRole('owner')){$user->assignRole(3);}
			}else if($owner==0){
			  if($user->hasRole('owner')){$user->removeRole(3);}
			}
			return Response::json($id);
  		}
	}
	public function deactivateUser(){
		if(Request::ajax()){
  			$input = Input::all();
  			$id = $input['id'];
  			DB::table('user')->where('id', '=', $id )
	->update(array('status' => 0));
  		}
	}
	public function activateUser(){
		if(Request::ajax()){
  			$input = Input::all();
  			$id = $input['id'];
  			DB::table('user')->where('id', '=', $id )
	->update(array('status' => 1));
  		}
	}
	/**
	 * Show the form for creating a new resource.
	 * GET /adminuser/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /adminuser
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /adminuser/{id}
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
	 * GET /adminuser/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($username)
	{
			$user = User::whereUsername($username)->firstOrFail();
			return View::make('admin.editUser')->withUser($user);
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /adminuser/{id}
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
	 * DELETE /adminuser/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}