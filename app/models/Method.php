<?php
class Method extends \Eloquent {
	protected $table = 'method';
	protected $guarded = ['id'];
	protected $fillable = [
		'methodName',
		'methodDesc'
		];
}