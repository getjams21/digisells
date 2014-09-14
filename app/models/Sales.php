<?php

class Sales extends \Eloquent {
	protected $table = 'sales';
	protected $guarded = ['id'];
	protected $fillable = [
		'productID',
		'auctionID',
		'sellingID',
		'buyerID',
		'amount',
		'transactionNO'
	];
}