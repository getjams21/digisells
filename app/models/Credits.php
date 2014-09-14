<?php

class Credits extends \Eloquent {
	protected $table = 'credits';
	protected $guarded = ['id'];
	protected $fillable = [
		'userID',
		'salesID',
		'creditAdded',
		'creditDeducted'
	];
}