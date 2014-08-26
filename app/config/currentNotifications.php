<?php 

 // Fetch the User object
	$id = Auth::user()->id;
	$user = User::find($id);
	$notifications = $user->notifications()->unread()->count();
	return $notifications;