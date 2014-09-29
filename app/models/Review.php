<?php

class Review extends \Eloquent {
	protected $table = 'reviews';
	protected $guarded = ['id'];
	protected $fillable = [
		'userID',
		'productID',
		'stars',
		'reviews'
	];
}