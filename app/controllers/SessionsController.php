<?php
use Acme\Forms\LoginForm;

class SessionsController extends \BaseController {
	protected $loginForm;

	function __construct(LoginForm $loginForm)
	{
		$this->loginForm = $loginForm;
	}
	
		/**
	 * Show the form for creating a new resource.
	 * 
	 * @return Response
	 */
	public function create()
	{
		return View::make('sessions.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		// $this->loginForm->validate($input = Input::only('username','password'));
		$input = Input::only('username','password');
		if(Auth::attempt($input))
		{
			return Redirect::intended('/');
		}
		return Redirect::to('login')->withInput()->withFlashMessage('<div class="alert alert-danger square" role="alert"><b>Invalid credentials provided!</b></div>');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id = null)
	{
		Auth::logout();

		return Redirect::home();
	}

}