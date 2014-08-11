<?php

class AuctionController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$category = Category::lists('categoryName','id');
		$subCategories = DB::table('Subcategory')->where('categoryID', 1)->lists('name','id');
		return View::make('pages.auction', compact('category','subCategories'));
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

	public function fetchSubCategory(){
		if(Request::ajax()){
  			$input = Input::all();
  			$val = $input['val'];
  			$subCategories = DB::table('Subcategory')->where('categoryID', $val)->lists('name','id');
			return Response::json($subCategories);
  		}
	}

}
