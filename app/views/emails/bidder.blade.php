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
			You have won an auction
				{{$auction->auctionName}} Auction Event
			for {{$bidding->amount}} USD
			<br><br>
			<div>
				<div class="well invoice-well-prop">
			<div class="container-fluid">
					<div class="breadcrumb brd-prod-name">
						<div class="logo" style="margin-left:175px;">
						<div style="padding-left:50px;padding-top:7px;"><font class="logo-text" size="6" color="white"><b>DigiSells</b></font></div>
						</div>
					</div>
					<hr class="style-fade" style="margin-bottmo:5px;">
					<div class="row">
						<div class="col-md-12">
						<div class="panel panel-primary border-none">
							<div class="panel-heading">Customer Information</div>
						  <div class="panel-body">
						    Name: <b>{{$user->lastName;}}, {{$user->firstName}}</b>
						    <br>
						    Address: <b>{{$user->address}}</b>
						    <br>
						    Email: <b>{{$user->email}}</b>
						  </div>
						</div>
						</div>
						<div class="col-md-12">
						<div class="panel panel-primary border-none">
							<div class="panel-heading">Product Information</div>
						  <div class="panel-body">
						  	<table class="table table-hover">
						  		<thead>
						  			<tr>
						  				<th>Name</th>
						  				<th>Seller</th>
						  				<th>Price</th>
						  				<th>Quantity</th>
						  				<th>Total Price</th>
						  			</tr>
						  		</thead>
						  		<tbody>
						  				<tr>
						  					<td>{{$product->productName}}</td>
						  					<td>{{$seller->firstName}} {{$seller->lastName}}</td>
						  					<td>${{round($auction->amount,2)}}</td>
						  					<td>{{$product->quantity}}</td>
						  					<td>${{round($bidding->amount,2)}}</td>
						  				</tr>
						  		</tbody>
						  	</table>
						  </div>
						</div>
						</div>
						<div class="col-md-12">
						<div class="alert alert-success" role="alert">
							Please pay for this item. <br>
							<a href="http://digisells.com/invoices"><b>Pay here</b>.</a> 
						</div>
						</div>		
				</div>
			</div>
		</div>
						
			</div>
			Log in to Digisells for more details
			<br>
			<br>

			Regards,<br>
			<b>Digisells Team</b> 
		</div>
	</body>
</html>
