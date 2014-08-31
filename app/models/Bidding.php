<?php

class Bidding extends \Eloquent {
	protected $table = 'bidding';
	protected $guarded = ['id'];
	protected $fillable = [
		'auctionID',
		'userID',
		'amount',
		'maxBid'
	];
}