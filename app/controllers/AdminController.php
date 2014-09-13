<?php

class AdminController extends \BaseController {

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
	public function users()
	{
		$status= Request::get('status') ?: '1' ;
		if(Request::get('status') !=1){$status=0;}
		$users =DB::select("select a.*,b.role from user as a inner join 
			(select a.user_id, GROUP_CONCAT(b.name SEPARATOR ', ') 
				as role FROM role_user as a inner join roles as b 
				on a.role_id=b.id group by a.user_id) as b on a.id=b.user_id 
				where status=".$status." order by created_at desc");
		if($status==1){$body='Active_Accounts';}else{$body='Inactive_Accounts';}
		return View::make('admin.users',['users'=>$users,'status'=>$status,'body'=>$body]);
	}
	public function auctions()
	{
		$status= Request::get('status') ?: '1' ;
		$expire= Request::get('expired') ?: '>' ;
		if(Request::get('status') !=1){$status=0;}
		if(Request::get('expired') ==1){$expire='<=';}
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