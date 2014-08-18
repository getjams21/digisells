<?php

class Paypal extends \Eloquent {
	protected $table = 'paypal';
	protected $guarded = ['id'];
	protected $fillable = [
		'paypalEmail',
		'paymentID'
		];
}