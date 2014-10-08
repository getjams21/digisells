<?php

class HomePageController extends \BaseController {

	public function index()
	{
		return View::make('pages.homepage');
	}

	public function selling(){
		$seller = User::find(Auth::user()->id);
		$hasPaypal = false;
		if($seller->paypal != NULL){
			$hasPaypal = true;
		}
		return View::make('pages.selling', compact('hasPaypal'));
	}
}
