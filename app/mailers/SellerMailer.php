<?php namespace Acme\Mailers;
use User;
class SellerMailer extends Mailer {

	public function seller(User $user)
	{
		$subject = 'Your Digisells Product has been Sold';
		$view = 'emails.seller';
		$data = [$user];

		return $this->sendTo($user,$subject,$view,$data);
	}
}