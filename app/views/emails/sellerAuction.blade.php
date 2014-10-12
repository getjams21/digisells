<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Hi {{$user->firstName}}</h2>

		<div>
			Good day,
			<br><br>
			Your
				{{$auction->auctionName}} Auction Event
			have just been sold for {{$sales->amount}} USD
			<br><br>
			Log in to Digisells for more details
			<br>
			<br>

			Regards,<br>
			<b>Digisells Team</b> 
		</div>
	</body>
</html>
