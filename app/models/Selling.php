<?php
use Carbon\Carbon;
class Selling extends \Eloquent {
	protected $table = 'selling';
	protected $guarded = ['id'];
	protected $fillable = [
		'sellingName',
		'productID',
		'price',
		'discount',
		'listingDate',
		'expirationDate',
		'affiliatePercentage'
	];
	public function getDates(){
		return ['created_at','updated_at','expirationDate'];
	}
}