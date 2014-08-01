<?php
use Acme\Forms\RegistrationForm;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UsersController extends \BaseController {
	protected $registrationForm;

	function __construct(RegistrationForm $registrationForm)
	{
		$this->registrationForm = $registrationForm;

		$this->beforeFilter('currentUser',['only' => ['edit','update']]);
	}
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('users.show');
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('users.register');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::only('firstName','lastName','address','username',
									'email','password','password_confirmation');
		$this->registrationForm->validate($input);
		$user = User::create($input);
		Auth::login($user);

		return Redirect::to('users');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $username
	 * @return Response
	 */
	public function show($username)
	{
		// if(Auth::guest())
		// {
		// 	return Redirect::to('login')->withInput()->withFlashMessage('<span class="error">Please Login to continue</span>');
		// }
		try
		{
			$user = User::whereUsername($username)->firstOrFail();
			return View::make('users.show',['user' => $user]);	
		}
		catch(ModelNotFoundException $e)
		{
			return Redirect::home();
		}	
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($username)
	{
		// if(Auth::guest() || $username != Auth::user()->username)
		// {
		// 	return Redirect::home();
		// }
		// if($username == Auth::user()->username)
		// {
			$user = User::whereUsername($username)->firstOrFail();
			return View::make('users.edit')->withUser($user);
		// }
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($username)
	{
		$user = User::whereUsername($username)->firstOrFail();
		$input = Input::only('firstName','lastName', 'address');

		$user->fill($input)->save();

		return Redirect::route('users.edit',$user->username)->withFlashMessage('<span class="success">Successfully Edited Profile</span>');;

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
