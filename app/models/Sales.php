<?php

class Sales extends \Eloquent {
	protected $table = 'sales';
	protected $guarded = ['id'];
	protected $fillable = [
		'auctionID',
		'sellingID',
		'buyerID',
		'amount',
		'transactionNO'
	];
}