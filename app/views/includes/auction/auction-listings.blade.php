<!-- bid modal -->
<div class="modal fade" id="bid-modal">
  <div class="modal-dialog bid-modal-prop">
    <div class="modal-content bid-body">
     	
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal fade buy-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-sm">
    <div class="modal-content modal-prop">
	    <center>
			{{ Form::open(['route'=>'sales.store']) }}
				<input class="confirm-buy" type="hidden" name="auctionID" value="">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
				<button type="submit" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-check">&nbsp;</span>Confirm Purchase</button>
			{{ Form::close() }}
		</center>
      <center><span class="glyphicon glyphicon-ok saved"></span><h4 class="saving"></h4></center>
    </div>
  </div>
</div>
<!-- End Modal -->
<!-- promote modal -->
<div class="modal fade promote-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-sm affiliate">
    <div class="modal-content modal-prop">
    	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	    <center>
	    	<div class="well">
	    		<center><h5>Copy and save your referral link</h5>
				<input type="text" id="affiliateLink" class="form-control" style="width:100%;" style="width:460px;margin-top:5px;">
				-or- <br>
				Use any of these banners and buttons
				<hr class="style-fade">
				<img src="../../../_/fonts/auction_banner_460x60.gif" width="460" hieght="60">
				<textarea class="form-control banner460x60" rows="4" style="width:460px;margin-top:5px;">
				</textarea>
				<hr class="style-fade">
				<img src="../../../_/fonts/banner_300x300.gif" width="280" hieght="280">
				<textarea class="form-control banner300x300" rows="4" style="width:460px;margin-top:5px;">
				</textarea>
				</center>
			</div>
		</center>
      <center><span class="glyphicon glyphicon-ok saved"></span><h4 class="saving"></h4></center>
    </div>
  </div>
</div>
<!-- end promote modal -->
<br>
	@include('includes.search');
	<div class="container">
		<div class="col-md-3">
		</div>
		<div class="col-md-9" style="background-color:white;">
			@if(Auth::user())
			<input id="currentID" type="text" value="{{Auth::user()->id}}" hidden>
			@endif
			@foreach($listings as $list)
			<br>
			<div class="container-fluid">
				<div class="well listing-prop">
					<div class="container-fluid">
						<div class="col-md-3">
							<div class="thumbnail shadow-default">
								<a href="/auction-listing/{{$list->id}}"><img src="../product/images/{{$list->imageURL}}" class="listing-img-prop"></a>
							</div>
							<button id="btn-buy" class="btn btn-success buy" value="{{$list->id}}"
								<?php 
								if(Auth::user()){
									if($list->userID == Auth::user()->id){
									echo "disabled";
									}
								}else{
									echo "disabled";
								}
								;?>
							><span class="glyphicon glyphicon-check"></span>&nbsp;Buy this for
								<font color="#992D31"><b>${{round($list->buyoutPrice, 2)}}</b></font>
							</button>
						</div>
						<div class="col-md-9 inactive">
							<a href="/auction-listing/{{$list->id}}"><div class="breadcrumb default-blue shadow-default"><center><h4>{{$list->auctionName}}</h4></center></div></a>
							<h5><b>
								<?php 
								if(Auth::user()){
									if($list->userID != Auth::user()->id ){
										if($list->highestBidder == Auth::user()->id){
											echo "You're the current highest bidder with";
										}else{
											echo "Current Highest Bid:";
										}
									}else{echo "Starting Price:";}
								}else{
										echo "Starting Price:";
									}
								?>
							<font color="#992D31">${{round($list->minimumPrice, 2)}}</font>&nbsp;&nbsp;&nbsp;Number of Bids:<font color="#992D31">&nbsp;{{($list->bidders)}}</font>
							&nbsp;&nbsp;&nbsp;Affiliate Commission:<font color="#992D31">&nbsp;{{($list->affiliatePercentage)}}%</font></b></h5>
							@if (Session::has('flash_message'))
								<div class="form-group ">
									<p>{{Session::get('flash_message') }}</p>
								</div>
							@endif
							<!-- <input type="hidden" id="endingDate" value="{{$list->endDate}}">
							<input type="hidden" id="auction-id" value="{{$list->id}}">
							<input type="hidden" id="isShow" value="0">
							<div class="countdown default"></div> -->
							<br>
							<p class="comment">{{$list->productDescription}}</p>
							<center>
						@if(Auth::guest())
							<a href="/login">
						@endif
							<div class="btn-group" >
								<button class="btn btn-primary bid" value="{{$list->id}}"
									<?php 
									if(Auth::user()){
										if($list->userID == Auth::user()->id){
										echo "disabled";
										}
									}
									?>
								><span class="glyphicon glyphicon-bell"></span>&nbsp;Bid for this</button>
								<button class="btn btn-success maxBid" value="{{$list->id}}"
									<?php 
									if(Auth::user()){
										if($list->userID == Auth::user()->id){
										echo "disabled";}
									}
									?>
								><span class="glyphicon glyphicon-circle-arrow-up"></span>&nbsp;Set Auto Outbid</button>

								<button id="watch{{$list->productID}}" 
									class="btn btn-warning watchProduct <?php if(!$list->watched || $list->watched==0){echo '';}else{echo ' hidden';};?>" 
									<?php 
									if(Auth::user()){
										if($list->userID == Auth::user()->id){
										echo "disabled";
										}else{
											echo "onclick='$(this).watchProduct(".$list->userID.",".$list->productID.", 1)'";
										}
									}
									?>>
									<span class="glyphicon glyphicon-eye-open">
									</span>&nbsp;Watch this</button>

								<button id="unWatch{{$list->productID}}" 
									style="background-color:green;" 
									class="btn btn-success unwatchProduct <?php if(!$list->watched || $list->watched==0){echo 'hidden';}else{echo ' ';};?>" 
									onclick="$(this).unwatchProduct({{$list->userID}},{{$list->productID}})">
									<span class="glyphicon glyphicon-ok">
									</span>&nbsp;Watched </button>
								<input type="hidden" id="isSelling" value="0">
								<button id="btn-promote" class="btn btn-success promote" value="{{$list->id}}"
									<?php 
									if(Auth::user()){
										if($list->userID == Auth::user()->id){
										echo "disabled";}
									}
									?>
								><span class="glyphicon glyphicon-bullhorn"></span>&nbsp;Promote this
								</button>
							</div>
						@if(Auth::guest())
							</a>
						@endif
							</center>
						</div>
					</div>
				</div>
			</div>
		@endforeach
		@if(!$listings)
			<div class="well"> 
				<div class="alert alert-danger" role="alert"><b>Oh snap! No Products Found!</b>  Please try our Refine Search</div>
			</div>
		@endif
			<div class="container-fluid lists">
			</div>
		<div class="loading">
			<center> <button class="btn btn-default load-more">Load More...</button>&nbsp;&nbsp;&nbsp;<img src="../_/fonts/loading.gif" width="32px" height="32px" id="loading-img"> </center>
		</div>
		<br>
	</div>
