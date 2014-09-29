<?php

class ReviewsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$productID = Input::get('productID');
		$product = Product::find($productID);
		return View::make('pages.review.product-review', compact('product'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$review = new Review;
		$review->userID = Auth::user()->id;
		$review->productID = Input::get('productID');
		$review->reviews = Input::get('review');
		$review->stars = Input::get('star');
		$review->save();

		return Redirect::action('DashboardController@invoices')
					->withFlashMessage('
					<b>Great!..Your feedback is saved!</b>&nbsp;<button type="button" class="close close-panel"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					');
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
