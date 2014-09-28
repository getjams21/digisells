<?php 

 // Fetch the User object
	$fund = DB::select('select sum(creditAdded)-sum(creditDeducted) as currentcredit from credits where userID='.Auth::user()->id);
	$currentcredit=$fund[0]->currentcredit;
	return $currentcredit;