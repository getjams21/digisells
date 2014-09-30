<?php

class Complaint extends \Eloquent {
	protected $table = 'complaints';
	protected $guarded = ['id'];
	protected $fillable = [
		'ticket',
		'tittle',
		'description'];
}