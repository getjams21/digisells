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
		$email = User::where('email', $input['username'])
		->first();
		$username =User::where('username', $input['username'])
		->first();
		if($email){$auth = 'email';}
		if($username){$auth='username';}
		$user=array($auth => $input['username'], 'password' => $input['password'], 'type'=> null);
		if(Auth::attempt($user))
		{
			if(Auth::user()->status == 1){
				if(Auth::user()->hasRole('admin')){
					return Redirect::to('/admin');
				}
				return Redirect::intended('/');
			}
			return Redirect::to('login')->withInput()->withFlashMessage('<div class="alert alert-danger square" role="alert"><b>Your account has been disabled!</b><br> Please contact Digisells for more information.</div>');
		}
		return Redirect::to('login')->withInput()->withFlashMessage('<div class="alert alert-danger square" role="alert"><b>Invalid credentials provided!</b></div>');
	}
	public function loginWithFacebook() {

    $code = Input::get( 'code' );
    $fb = OAuth::consumer( 'Facebook');
    if ( !empty( $code ) ) {
        $token = $fb->requestAccessToken( $code );
        $result = json_decode( $fb->request( '/me' ), true );
        // echo '<pre>';
        // return dd($result);
        $user=array('username' => $result['id'], 'password' => $result['id']);
        if(Auth::attempt($user))
		{
			if(Auth::user()->status == 1){
				if(Auth::user()->hasRole('admin')){
					return Redirect::to('/admin');
				}
				return Redirect::intended('/');
			}
			return Redirect::to('login')->withInput()->withFlashMessage('<div class="alert alert-danger square" role="alert"><b>Your account has been disabled!</b><br> Please contact Digisells for more information.</div>');
		}else{

			$find = User::whereEmail($result['email'])->first();
			if(!$find){
				// echo '<pre>';
				// return dd($result);
				$user = new User;
				$user->username=$result['id'];
				$user->email=$result['email'];
				$user->password=$result['id'];
				$user->type='facebook';
				$user->firstName=$result['first_name'];
				$user->lastName=$result['last_name'];
				$user->save();
				if($user->id == 1){
					$user->roles()->attach(2);	
					$user->roles()->attach(3);	
				}
					$user->roles()->attach(1);
					Auth::login($user);
					if($user->id == 1){
						return Redirect::to('/admin');
					}
					return Redirect::home();
				}
				return Redirect::to('login')->withInput()->withFlashMessage('<div class="alert alert-danger square" role="alert"><b>The email associatied with your facebook account has been taken.</div>');
			}
     }
    else {
        $url = $fb->getAuthorizationUri();
         return Redirect::to( (string)$url );
    }
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