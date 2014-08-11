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
				$fileSize = Input::file('userImage')->getSize();
				
				// file should be an image
				$validator = Validator::make(
					array('userImage'=> $file),
					array('userImage' =>'image|max:2000000|mimes:jpg,jpeg,bmp,png')
					);
				if($validator->fails()){
					return Redirect::back()->withInput()->withErrors($validator, 'userImage');
				}else{	
					if($fileSize>2000000){
				return Redirect::back()->withInput()->withFlashMessage('<center><div class="alert alert-danger square">Image must be less than 2mb</div></center>');
					}	
					if (File::exists(user_photos_path())) {
						File::deleteDirectory(user_photos_path());
					}
					$file->move(user_photos_path() ,$fileName);
					$user->userImage = $fileName;
				}
			}
		$user->fill($input)->save();
		$user->save();
		return Redirect::route('users.edit',$user->username)
		->withFlashMessage('<div class="alert alert-success square" ><center><b>Successfully Updated Profile</b></center></div>');
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
	public function updateAccount()
	{
  		$user = Auth::user();
	    $rules = array(
	        'old_password' => 'required|alphaNum|between:6,16',
	        'password' => 'required|alphaNum|between:6,16|confirmed'
	    );
	    $validator = Validator::make(Input::only('old_password','password','password_confirmation'), $rules);
	    if ($validator->fails()) 
	    {
	        return Redirect::back()->withErrors($validator,'old_password');
	    }else{
		    if (!Hash::check(Input::get('old_password'), $user->password)) 
	        {
	            return Redirect::back()->withFlashMessage('<center><div class="alert alert-danger square">Your Old password does not match</div></center>');
	        }
	        else
	        {
	            $user->password = Input::get('password');
	            $user->save();
	            Auth::logout();
	            return Redirect::to('login')->withFlashMessage('<center><div class="alert alert-success square">You have successfully changed your password.<br>Login to continue</div></center>');
	        }
	    }

	}

}
