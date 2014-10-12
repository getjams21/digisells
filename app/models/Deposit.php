<?php

class Deposit extends \Eloquent {
	protected $table = 'deposit';
	protected $guarded = ['id'];
	protected $fillable = [
		'paypalEmail',
		'paymentID'
		];
}