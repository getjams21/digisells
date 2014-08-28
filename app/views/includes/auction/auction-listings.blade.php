<br>
	<div class="container">
		<div class="col-md-3 refine-search">
			<h3>Refine Search</h3>
		</div>
		<div class="col-md-9">
			@foreach($listings as $list)
			<div class="container-fluid">
				<div class="well">
					<div class="container-fluid">
						<div class="col-md-3">
							<div class="thumbnail shadow-default">
								<img src="../product/images/{{$list->imageURL}}" class="listing-img-prop">
							</div>
						</div>
						<div class="col-md-9">
							<h4>{{$list->auctionName}}</h4>
							<h5><b>Starting Bid: <font color="#992D31">${{round($list->minimumPrice, 2)}}</font></b></h5>
							<p>{{$list->productDescription}}</p>
							<div class="btn-group">
								<button class="btn btn-primary"><span class="glyphicon glyphicon-bell"></span>&nbsp;Bid for this</button>
								<button class="btn btn-success"><span class="glyphicon glyphicon-check"></span>&nbsp;Buy this for <font color="#992D31"><b>${{round($list->buyoutPrice, 2)}}</font></b></button>
								<button class="btn btn-warning"><span class="glyphicon glyphicon-eye-open"></span>&nbsp;Watch this</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		@endforeach
			<div class="container-fluid lists">
			</div>
		<div class="loading">
			<center> <img src="../_/fonts/loading.gif" width="32px" height="32px"> </center>
		</div>
	</div>
