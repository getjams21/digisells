<?php

class Watchlist extends \Eloquent {
	protected $table = 'watchlist';
	protected $guarded = ['id'];
	protected $fillable = [];

// public function user()
//     {
//         return $this->belongsTo('User');
//     }
}