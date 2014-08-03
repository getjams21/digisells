<?php

function errors_for($attribute, $errors)
{
	return $errors ->first($attribute,'<span class="bg-danger error">:message</span>');
}

function link_to_profile()
{
	return link_to('/users/'.Auth::user()->username, Auth::user()->username);
}