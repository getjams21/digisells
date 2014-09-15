<div class="modal fade" id="bid-modal">
  <div class="modal-dialog bid-modal-prop">
    <div class="modal-content bid-body">
     	
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@foreach($auctionEvent as $auction)
<div class="col-md-12">
	<div class="container">
		<div class="well product-well-prop">
			<div class="container-fluid">
				<div class="col-md-5">
					<div class="thumbnail thumbnail-size shadow-default">
						<img src="../product/images/{{$auction->imageURL}}" class="product-img-prop">
					</div>
					<center><button class="btn btn-success btn-lg buyout"><span class="glyphicon glyphicon-check">&nbsp;</span>Buy this for ${{round($auction->buyoutPrice, 2)}}</button></center>
				</div>
				<div class="col-md-7">
					<div class="breadcrumb brd-prod-name shadow-default">
						<center>
							<span>{{$auction->auctionName}}</span>
						</center>
					</div>
					<div class="reviews">
						<center><p><input id="input-5a" class="rating" data-readonly="true" data-size="xs" data-show-clear="false" data-show-caption="true" value="0">&nbsp;No Customer Reviews</p> </center>
					</div>
					<div class="panel expiration-date square">
						<center>
							<span>This auction will end on
								{{
									date("d F Y",strtotime($auction->endDate)) }} at {{ date("g:ha",strtotime($auction->endDate));
								}}
							</span>
							<br>
						</center>
					</div>
					<input type="hidden" id="endingDate" value="{{$auction->endDate}}">
					<input type="hidden" id="auction-id" value="{{$auction->id}}">
					<input type="hidden" id="isShow" value="1">
					<center><b><div class="countdown default"></div></b></center>
					<br>
					<div class="well well-bid">
						<center><div class="price">
							<span><h2>
							<?php 
								if($auction->userID != Auth::user()->id){
									if($auction->highestBidder == Auth::user()->id){
										echo "You're the current highest bidder with";
									}else{
										echo "Current Highest Bid:";
									}
								}else{
										echo "Starting Price:";
								}
							;?> ${{round($auction->amount, 2)}}</h2></span>
						</div>
						<div class="bidders">
							<span>Number of Bids: &nbsp;<font color="#992D31" size="3"><b>{{($auction->bidders)-1}}</b></font></span>
						</div>
						<span>Enter Bid
							@if ($auction->incrementation == '0')
								<?php $incBy = $auction->amount * 0.05;
								$incValue = $auction->amount + $incBy; ?>
							@else
								<?php $incValue = $auction->amount + $auction->incrementation; ?>
							@endif
							<font color="#992D31" size="3"><b>${{round($incValue, 2);}}</b></font> or higher</span>
						{{ Form::open(['route'=>'place-bid.store']) }}
						<div class="input-group txtbox-s prop-s">
		                    <span class="input-group-addon">$</span>
		                    <input class="form-control span3" placeholder="Bid Price" id="bidPrice" required="required" name="bidPrice" type="text" value="">
		                    <input type="hidden" name="auctionID" value="{{$auction->id}}">
	                		<input type="hidden" name="minPrice" value="{{$incValue}}">        
	                	</div>
	                	@if (Session::has('flash_message'))
							<div class="form-group ">
								<p>{{Session::get('flash_message') }}</p>
							</div>
						@endif
	                	<div class="btn-group">
						<button type="submit" class="btn btn-primary bid"
							<?php if($auction->userID == Auth::user()->id){
									echo "disabled";
								};?>>
							<span class="glyphicon glyphicon-bell">&nbsp;</span>Place Bid
						</button>
						{{ Form::close() }}
						<button type="button" class="btn btn-success show-maxBid maxBid" value="{{$auction->id}}"
							<?php if($auction->userID == Auth::user()->id){
								echo "disabled";
							};?>
						><span class="glyphicon glyphicon-circle-arrow-up"></span>&nbsp;Set Auto Outbid</button>
						<button id="watch{{$auction->productID}}" 
							class="btn btn-warning watchProduct <?php if(!$auction->watched || $auction->watched==0){echo '';}else{echo ' hidden';};?>" 
							onclick="$(this).watchProduct({{$auction->userID}},{{$auction->productID}}, 1)" 
							<?php if($auction->userID == Auth::user()->id){
								echo "disabled";
							};?>>
							<span class="glyphicon glyphicon-eye-open">
							</span>&nbsp;Watch this</button>

						<button id="unWatch{{$auction->productID}}" 
							style="background-color:green;" 
							class="btn btn-success unwatchProduct <?php if(!$auction->watched || $auction->watched==0){echo 'hidden';}else{echo ' ';};?>" 
							onclick="$(this).unwatchProduct({{$auction->userID}},{{$auction->productID}})">
							<span class="glyphicon glyphicon-ok">
							</span>&nbsp; Watched </button>
						</div>
					</div>
					<br>
					<div class="desc-text-prop">
						<center><p>{{$auction->productDescription}}</p></center>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endforeach