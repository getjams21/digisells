<?php 

Event::listen('auth.logout', function($user)
{
    $user->last_logout = new DateTime;
    $user->save();
});