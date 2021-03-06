<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use Carbon\Carbon;

class User extends Eloquent implements UserInterface, RemindableInterface {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'user';
	protected $fillable = ['firstName','lastName','address','username','email','password','last_activity'];
	protected $guarded = array('id');
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');
	public function getDates(){
		return ['created_at','updated_at','last_activity'];
	}
	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the token value for the "remember me" session.
	 *
	 * @return string
	 */
	public function getRememberToken()
	{
		return $this->remember_token;
	}

	/**
	 * Set the token value for the "remember me" session.
	 *
	 * @param  string  $value
	 * @return void
	 */
	public function setRememberToken($value)
	{
		$this->remember_token = $value;
	}

	/**
	 * Get the column name for the "remember me" token.
	 *
	 * @return string
	 */
	public function getRememberTokenName()
	{
		return 'remember_token';
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

	public function setPasswordAttribute($password)
	{
		$this->attributes['password'] = Hash::make($password);
	}
	public function isCurrent()
	{
		if (Auth::guest()) return false;

		return Auth::user()->id == $this->id;
	}
	public function notifications()
	{
	    return $this->hasMany('Notification');
	}
	public function newNotification()
	{
	    $notification = new Notification;
	    $notification->user()->associate($this);
	 
	    return $notification;
	}
	public function roles()
	{
		return $this->belongsToMany('Role')->withTimestamps();
	}
	public function hasRole($name)
	{
		foreach ($this->roles as $role)
		{
			if ($role->name == $name) return true;
		}
		return false;
	}
	public function assignRole($role)
	{
		return $this->roles()->attach($role);
	}
	public function removeRole($role)
	{
		return $this->roles()->detach($role);
	}
	// public function watchlists()
	// {
	// 	return $this->belongsToMany('Watchlist','userID');
	// }
}
