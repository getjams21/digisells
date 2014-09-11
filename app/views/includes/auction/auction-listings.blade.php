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
			<input id="currentID" type="text" value="{{Auth::user()->id}}" hidden>
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
						<div class="col-md-9 inactive">
							<a href="/auction-listing/{{$list->id}}"><div class="breadcrumb default-blue shadow-default"><center><h4>{{$list->auctionName}}</h4></center></div></a>
							<h5><b><?php 
								if($list->userID != Auth::user()->id){
									if($list->highestBidder == Auth::user()->id){
										echo "You're the current highest bidder with";
									}else{
										echo "Current Highest Bid:";
									}
								}else{
										echo "Starting Price:";
								} ?>
							<font color="#992D31">${{round($list->minimumPrice, 2)}}</font>&nbsp;&nbsp;&nbsp;Number of Bids:<font color="#992D31">&nbsp;{{($list->bidders)}}</font></b></h5>
							<p class="comment">{{$list->productDescription}}</p>
							<center>
							<div class="btn-group">
								<button class="btn btn-primary bid" value="{{$list->id}}"
									<?php if($list->userID == Auth::user()->id){
										echo "disabled";
									};?>
								><span class="glyphicon glyphicon-bell"></span>&nbsp;Bid for this</button>
								<button class="btn btn-success maxBid" value="{{$list->id}}"
									<?php if($list->userID == Auth::user()->id){
										echo "disabled";
									};?>
								><span class="glyphicon glyphicon-circle-arrow-up"></span>&nbsp;Set Auto Outbid</button>

								<button id="watch{{$list->productID}}" 
									class="btn btn-warning watchProduct <?php if(!$list->watched || $list->watched==0){echo '';}else{echo ' hidden';};?>" 
									onclick="$(this).watchProduct({{$list->userID}},{{$list->productID}}, 1)" 
									<?php if($list->userID == Auth::user()->id){
										echo "disabled";
									};?>>
									<span class="glyphicon glyphicon-eye-open">
									</span>&nbsp;Watch this</button>

								<button id="unWatch{{$list->productID}}" 
									style="background-color:green;" 
									class="btn btn-success unwatchProduct <?php if(!$list->watched || $list->watched==0){echo 'hidden';}else{echo ' ';};?>" 
									onclick="$(this).unwatchProduct({{$list->userID}},{{$list->productID}})">
									<span class="glyphicon glyphicon-ok">
									</span>&nbsp;Watched </button>
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
