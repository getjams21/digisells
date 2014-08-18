<?php

class Selling extends \Eloquent {
	protected $table = 'selling';
	protected $guarded = ['id'];
	protected $fillable = [
		'sellingName',
		'productID',
		'price',
		'discount',
		'listingDate',
		'expirationDate',
		'affiliatePercentage'
	];
}