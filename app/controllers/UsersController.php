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
		return Redirect::home();
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
		$input = Input::only('username','email','password','password_confirmation');
		$this->registrationForm->validate($input);
		$user = User::create($input);
		Auth::login($user);

		return Redirect::home();
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $username
	 * @return Response
	 */
	public function show($username)
	{
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
			$user = User::whereUsername($username)->firstOrFail();
			return View::make('users.edit')->withUser($user);
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
		if(Input::hasFile('userImage'))
		{
			$file = Input::file('userImage');
			$fileName = $file->getClientOriginalName();
			$extension = $file->getClientOriginalExtension();
			if(File::exists(user_photos_path()))
			{
				File::delete(user_photos_path());
			}else{
			File::exists(user_photos_path());
			}
			$file->move(user_photos_path() ,$fileName);
			$user->userImage = $fileName;
			// return [
			// 'path' => $file->getRealPath(),
			// 'size' => $file->getSize(),
			// 'mime' => $file->getMimeType(),
			// 'name' => $file->getClientOriginalName(),
			// 'extension' => $file->getClientOriginalExtension()
			// ];
		}
		$user->fill($input)->save();
		$user->save();
		File::delete(user_photos_path());

		return Redirect::route('users.edit',$user->username)->withFlashMessage('<p class="bg-success success" ><b>Successfully Updated Profile</b></p>');

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
	
	public function searchPostUser()
	{
  		if(Request::ajax()){
  			$input = Input::only('username');
  			$a=$input['username'];
  			$user = User::whereUsername($a)->first();
  			if(count($user) >= 1){
  				return Response::json(1);
  			}
  			else{
  				return Response::json(0);
  			}
  		}
	}
	public function searchPostEmail()
	{
  		if(Request::ajax()){
  			$input = Input::only('email');
  			$a=$input['email'];
  			$user = User::whereEmail($a)->first();
  			if(count($user) >= 1){
  				return Response::json(1);
  			}
  			else{
  				return Response::json(0);
  			}
  		}
	}

}
