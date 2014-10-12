<?php namespace Acme\Mailers;
use User;
class UserMailer extends Mailer {

	public function welcome(User $user)
	{
		$subject = 'Welcome to Digisells';
		$view = 'emails.welcome';
		$data = [];

		return $this->sendTo($user,$subject,$view,$data);
	}
}