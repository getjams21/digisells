<?php

class Affiliate extends \Eloquent {
	protected $table = 'affiliates';
	protected $guarded = ['id'];
	protected $fillable = [
		'userID',
		'auctionID',
		'sellingID',
		'referralLink'
	];
}