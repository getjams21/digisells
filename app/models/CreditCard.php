<?php

class CreditCard extends \Eloquent {
	protected $table = 'creditcard';
	protected $guarded = ['id'];
	protected $fillable = [
		'cardType',
		'cardNumber',
		'paymentID'
	];
}