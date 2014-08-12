<?php

class Copyright extends \Eloquent {
	protected $table = 'copyright';
	protected $guarded = ['id'];
	protected $fillable = [
		'productID',
		'supportingFiles',
		'description'
	];
}