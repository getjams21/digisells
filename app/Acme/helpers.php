<?php

function errors_for($attribute, $errors)
{
	return $errors ->first($attribute,'<span class="bg-danger error">:message</span>');
}

function link_to_profile()
{
	return link_to('/users/'.Auth::user()->username, 'Dashboard');
}

function user_photos_path()
{
	return public_path() .'/images/'.Auth::user()->username.'/';
}