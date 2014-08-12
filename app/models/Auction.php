<?php

class Auction extends \Eloquent {
	protected $table = 'auction';
	protected $guarded = ['id'];
	protected $fillable = [
		'AuctionName',
		'productID',
		'minimumPrice',
		'buyoutPrice',
		'startDate',
		'endDate',
		'incrementation',
		'affiliatePercentage'
	];
}