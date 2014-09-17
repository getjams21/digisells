<div class="container">
	<div class="col-md-12">
		<div class="col-md-8 col-md-offset-2">
			<div class="well invoice-well-prop">
			<div class="container-fluid">
					<div class="breadcrumb brd-prod-name">
						<div class="logo" style="margin-left:175px;">
						<div style="padding-left:50px;padding-top:7px;"><font class="logo-text" size="6" color="white"><b>DigiSells</b></font></div>
						</div>
					</div>
					<span><h4>Invoice #: {{$sales->transactionNO}}</h4></span>
					<hr class="style-fade" style="margin-bottmo:5px;">
					<div class="row">
						<div class="col-md-12">
						<div class="panel panel-primary border-none">
							<div class="panel-heading">Customer Information</div>
						  <div class="panel-body">
						    Name: <b>{{Auth::user()->lastName;}}, {{Auth::user()->firstName}}</b>
						    <br>
						    Address: <b>{{Auth::user()->address}}</b>
						    <br>
						    Email: <b>{{Auth::user()->email}}</b>
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
						  					<td>${{round($auction->buyoutPrice,2)}}</td>
						  					<td>{{$product->quantity}}</td>
						  					<td>${{round($sales->amount,2)}}</td>
						  				</tr>
						  		</tbody>
						  	</table>
						  </div>
						</div>
						</div>
						<div class="col-md-8 col-md-offset-2">
						<div class="panel panel-primary">
							<div class="panel-heading">Purchase Summary</div>
						  <div class="panel-body">
						    Date: <b>{{date("m-d-Y")}}</b>
						    <br>
						    Credits Earned: <b>{{round($credits->creditAdded, 2)}}</b>
						    <br>
						    Total Credits: <b>{{round($totalCredits, 2)}}</b>
						    <br>
						    Total Purchase: <b>${{round($sales->amount,2)}}</b>
						  </div>
						</div>
						</div>
						<div class="col-md-12">
						<div class="alert alert-success" role="alert">
							Thank you for your purchase. The product download link was sent to your email <b><i>{{Auth::user()->email}}</i></b>.
						</div>
						</div>		
				</div>
			</div>
		</div>
	</div>
</div>
