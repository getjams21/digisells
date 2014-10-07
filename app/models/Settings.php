<?php

class Settings extends \Eloquent {
	protected $table = 'settings';
	protected $guarded = ['id'];
	protected $fillable = [
		'buyer',
		'company',
		'reward',
		'sellingFee'
	];
}