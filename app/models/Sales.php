<?php

class Sales extends \Eloquent {
	protected $table = 'sales';
	protected $guarded = ['id'];
	protected $fillable = [
		'auctionID',
		'sellingID',
		'affiliateID',
		'buyerID',
		'amount',
		'transactionNO'
	];
}