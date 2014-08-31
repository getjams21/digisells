<!-- bid modal -->
<div class="modal fade" id="bid-modal">
  <div class="modal-dialog bid-modal-prop">
    <div class="modal-content bid-body">
     	
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<br>	
		<div class="col-md-3 refine-search">
			<h3>Refine Search</h3>
		</div>
	<div class="container">
		<div class="col-md-3">
		</div>
		<div class="col-md-9" style="background-color:white;">
			@foreach($listings as $list)
			<br>
			<div class="container-fluid">
				<div class="well listing-prop">
					<div class="container-fluid">
						<div class="col-md-3">
							<div class="thumbnail shadow-default">
								<a href="/auction-listing/{{$list->id}}"><img src="../product/images/{{$list->imageURL}}" class="listing-img-prop"></a>
							</div>
							<button class="btn btn-success"><span class="glyphicon glyphicon-check"></span>&nbsp;Buy this for <font color="#992D31"><b>${{round($list->buyoutPrice, 2)}}</font></b></button>
						</div>
						<div class="col-md-9">
							<a href="/auction-listing/{{$list->id}}"><div class="breadcrumb default-blue shadow-default"><center><h4>{{$list->auctionName}}</h4></center></div></a>
							<h5><b>Starting Bid: <font color="#992D31">${{round($list->minimumPrice, 2)}}</font></b></h5>
							<p class="comment">{{$list->productDescription}}</p>
							<center>
							<div class="btn-group">
								<button class="btn btn-primary bid" value="{{$list->id}}"><span class="glyphicon glyphicon-bell"></span>&nbsp;Bid for this</button>
								<button class="btn btn-success"><span class="glyphicon glyphicon-circle-arrow-up"></span>&nbsp;Set Auto Outbid</button>
								<button class="btn btn-warning"><span class="glyphicon glyphicon-eye-open"></span>&nbsp;Watch this</button>
								
							</div>
							</center>
						</div>
					</div>
				</div>
			</div>
		@endforeach
			<div class="container-fluid lists">
			</div>
		<div class="loading">
			<center> <button class="btn btn-default load-more">Load More...</button>&nbsp;&nbsp;&nbsp;<img src="../_/fonts/loading.gif" width="32px" height="32px" id="loading-img"> </center>
		</div>
		<br>
	</div>
