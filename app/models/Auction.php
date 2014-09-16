<?php
class Auction extends \Eloquent {
	protected $table = 'auction';
	protected $guarded = ['id'];
	protected $fillable = [
		'auctionName',
		'productID',
		'minimumPrice',
		'buyoutPrice',
		'startDate',
		'endDate',
		'incrementation',
		'affiliatePercentage',
		'sold'
	];
}