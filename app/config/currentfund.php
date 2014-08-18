<?php 

 // Fetch the User object
	$user = Auth::user()->id;
	$fund = DB::select('select sum(amountAdded)-sum(amountDeducted) as currentfund from funds where userID='.$user);
	$currentfund=$fund[0]->currentfund;
	return $currentfund;