<?php

class Funds extends \Eloquent {
	protected $table = 'funds';
	protected $guarded = ['id'];
	protected $fillable = [
		'amountAdded',
		'amountDeducted',
		'paymentID'
		];
}