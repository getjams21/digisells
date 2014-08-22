<?php

function errors_for($attribute, $errors)
{
	return $errors ->first($attribute,'<div class="alert alert-danger square">:message</div>');
}

function link_to_profile()
{
	return link_to('/dashboard', 'Dashboard');
}
function user_photos_path()
{
	return public_path() .'/images/users/'.Auth::user()->username.'/';
}
function user_photos_display($user)
{
	return '/images/users/'.$user->username."/".$user->userImage;
}
function auth_redirect($user)
{
	if($user == Auth::user()->username){
		return true;
	}else{
		return false;
	}
}
function carbonize($value)
{
	$date = new Carbon($value);
	return $date;
}
function dateformat($date){
	return date("d F Y",strtotime($date));
}
function timeformat($time){
	return date("g:ha",strtotime($time));
}