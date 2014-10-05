<?php

class Complaintdetails extends \Eloquent {
	protected $table = 'complaintdetails';
	protected $guarded = ['id'];
	protected $fillable = [
			'complaintID',
			'senderID',
			'descriptions'
	];
}