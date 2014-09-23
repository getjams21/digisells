<?php

function errors_for($attribute, $errors)
{
	return $errors ->first($attribute,'<div class="alert alert-danger square">:message</div>');
}
function link_to_profile()
{
	return link_to('/dashboard', 'Dashboard');
}
function user_photos_path($user)
{
	return public_path() .'/images/users/'.$user->username.'/';
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
function timeformat($date){
	return date("g:i a",strtotime($date));
}
function Human($date){
	$date = new Carbon($date);
	$newdate= $date->diffForHumans();
	return $newdate;
}
function thisRole($id,$role){
	$user = User::find($id);
	if($user->hasRole($role)){
		return true;
	}else{
		return false;
	}
}
function money($money){
	$newmoney = number_format($money,2);
	return $newmoney;
}
// function sortBy($column,$body,$route)
// {
// 	$direction = (Request::get('direction')=='asc') ? 'desc' : 'asc';
// 	return link_to_route($route, $body, ['sortBy'=>$column,'direction'=>$direction]);
// }