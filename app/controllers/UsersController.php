<?php
use Acme\Forms\RegistrationForm;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Carbon\Carbon;
use PayPal\Types\AA\GetVerifiedStatusRequest;
use PayPal\Types\AA\AccountIdentifierType;
use PayPal\Service\AdaptiveAccountsService;
use Acme\Mailers\UserMailer as Mailer;
class UsersController extends \BaseController {
	protected $registrationForm;

	function __construct(RegistrationForm $registrationForm , Mailer $mailer)
	{
		$this->registrationForm = $registrationForm;
		$this->beforeFilter('currentUser',['only' => ['edit','update']]);
		$this->beforeFilter('guest',['only' => ['create']]);
		$this->mailer = $mailer;
	
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
		DB::table('user')->where('id', '=', $user->id)
	->update(array('firstName' =>  $user->username));
		if($user->id == 1){
			$user->roles()->attach(2);	
			$user->roles()->attach(3);	
		}
		$user->roles()->attach(1);
		$this->mailer->welcome($user);
		Auth::login($user);
		if($user->id == 1){
			return Redirect::to('/admin');
		}
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
			$activity=$user->last_activity->diffForHumans();
			$member=$user->created_at->diffForHumans();
			$watched=null;
			if(Auth::user()){
			$watched =DB::select("select status from watchlist where watcherID=".Auth::user()->id." and userID=".$user->id. " and productID is null");
			}
			return View::make('users.show',['user' => $user,'activity' => $activity,'member' => $member,'watched'=>$watched]);	
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
		// echo '<pre>';
		// return dd(Input::file('userImage'));
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
					if (File::exists(user_photos_path($user))) {
						File::deleteDirectory(user_photos_path($user));
					}
					$file->move(user_photos_path($user) ,$fileName);
					$user->userImage = $fileName;
				}
			}
		$user->fill($input)->save();
		$user->save();
		return Redirect::back()
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
	        'old_password' => 'required|alphaNum|between:6,30',
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
	public function updatePaypal(){
		$input= Input::all();
		$user = Auth::user();
		$rules = array(
		        'password' => 'required|alphaNum|between:6,16'
		    );
		    $validator = Validator::make(Input::only('password'), $rules);
		    if ($validator->fails()) 
		    {
		        return Redirect::back()->withInput()->withErrors($validator,'password');
		    }else{
			    if (!Hash::check(Input::get('password'), $user->password)) 
		        {
		            return Redirect::back()->withInput()->withFlashMessage('<center><div class="alert alert-danger square">Your password does not match</div></center>');
		        }
		    }
		 $sdkConfig = array(
			"mode" => "sandbox",
			"acct1.UserName" => "digisells_api1.admin.com",
			"acct1.Password" => "PFT5XFQ42YDDEJYM",
			"acct1.Signature" => "An5ns1Kso7MWUdW4ErQKJJJ4qi4-AfQR4MeCy8ViZ7PE4umi3Me1o3PU",
			"acct1.AppId" => "APP-80W284485P519543T"
		);
		$getVerifiedStatus = new GetVerifiedStatusRequest();
		$accountIdentifier=new AccountIdentifierType();
		$accountIdentifier->emailAddress = $input['email'];
		$getVerifiedStatus->accountIdentifier=$accountIdentifier;
		$getVerifiedStatus->firstName = $input['firstName'];
		$getVerifiedStatus->lastName = $input['lastName'];
		$getVerifiedStatus->matchCriteria = 'NAME';

		$service  = new AdaptiveAccountsService($sdkConfig);
			try {
				$response = $service->GetVerifiedStatus($getVerifiedStatus);
			} catch(Exception $ex) {
				return Redirect::back()->withInput()->withFlashMessage('<center><div class="alert alert-danger square"><b>Request Timeout!</b> Please check your Internet Connections.</div></center>');
				exit;
			} 

			// ## Accessing response parameters
			// You can access the response parameters as shown below
		$ack = strtoupper($response->responseEnvelope->ack);
		if($ack != "SUCCESS"){
			return Redirect::back()->withInput()->withFlashMessage('<center><div class="alert alert-danger square">Please provide a verified Paypal Account</div></center>');	
		}elseif($ack == "SUCCESS"){
			$user->paypal = $input['email'];
	        $user->save();
			return Redirect::back()->withInput()->withFlashMessage('<center><div class="alert alert-success square">Successfully updated paypal email.</div></center>');	

		}
	}

}
