<?php

class Product extends \Eloquent {
	protected $table = 'product';
	protected $guarded = ['id'];
	protected $fillable = [
		'subcategoryID',
		'userID',
		'productName',
		'productDescription',
		'quantity',
		'imageURL',
		'downloadLink'
	];
}