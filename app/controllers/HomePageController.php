<?php

class HomePageController extends \BaseController {

	public function index()
	{
		return View::make('pages.homepage');
	}

	public function selling(){
		return View::make('pages.selling');
	}
}
