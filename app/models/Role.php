<?php

class Role extends \Eloquent {
	protected $table = 'roles';
	protected $fillable = ['name'];
	public function user()
    {
        return $this->belongsTo('User');
    }
}