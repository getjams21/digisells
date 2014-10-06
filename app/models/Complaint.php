<?php

class Complaint extends \Eloquent {
	protected $table = 'complaints';
	protected $guarded = ['id'];
	protected $fillable = [
		'ticket',
		'title',
		'category',
		'priority',
		'screenshot'
		];
}