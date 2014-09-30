<div class="modal fade" id="bid-modal">
  <div class="modal-dialog bid-modal-prop">
    <div class="modal-content bid-body">
     	
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@foreach($auctionEvent as $auction)
<!-- buy modal -->
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
<!-- End buy Modal -->
<div class="col-md-12">
	<div class="container">
		<div class="well product-well-prop">
			<div class="container-fluid">
				<div class="col-md-5">
					<div class="thumbnail thumbnail-size shadow-default">
						<img src="../product/images/{{$auction->imageURL}}" class="product-img-prop">
					</div>
					<center>
						<input type="hidden" id="isSelling" value="0">
						<button class="btn btn-success btn-lg buy" value="{{$auction->id}}"
						<?php 
							if(Auth::user()){
								if($auction->userID == Auth::user()->id){
								echo "disabled";
								}
							}else{echo 'disabled';}
						?>
						><span class="glyphicon glyphicon-check">&nbsp;</span>Buy this for ${{round($auction->buyoutPrice, 2)}}</button>
					</center>
				</div>
				<div class="col-md-7">
					<div class="breadcrumb brd-prod-name shadow-default">
						<center>
							<span>{{$auction->auctionName}}</span>
						</center>
					</div>
					<div class="reviews">
						<center><p><input id="input-5a" class="rating" data-readonly="true" data-size="xs" data-show-clear="false" data-show-caption="true" value="<?php
							if($auction->stars == NULL){
								echo '0';
							}else{
								echo $auction->stars;
							}
						?>">&nbsp;No Customer Reviews</p> </center>
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
							if(Auth::user()){
								if($auction->userID != Auth::user()->id){
									if($auction->highestBidder == Auth::user()->id){
										echo "You're the current highest bidder with";
									}else{
										echo "Current Highest Bid:";
									}
								}else{echo "Starting Price:";
								}
							}else{echo "Starting Price:";}
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
					@if(Auth::guest())
					<a href="/login">
					@endif
	                	<div class="btn-group">
						<button type="submit" class="btn btn-primary bid"
							<?php 
							if(Auth::user()){
								if($auction->userID == Auth::user()->id){
									echo "disabled";
								}	
							}else{echo 'disabled';}
							?>>
							<span class="glyphicon glyphicon-bell">&nbsp;</span>Place Bid
						</button>
						{{ Form::close() }}
						<button type="button" class="btn btn-success show-maxBid maxBid" value="{{$auction->id}}"
							<?php 
							if(Auth::user()){
								if($auction->userID == Auth::user()->id){
								echo "disabled";
								}
							}else{echo 'disabled';}
							?>
						><span class="glyphicon glyphicon-circle-arrow-up"></span>&nbsp;Set Auto Outbid</button>
						<button id="watch{{$auction->productID}}" 
							class="btn btn-warning watchProduct <?php if(!$auction->watched || $auction->watched==0){echo '';}else{echo ' hidden';};?>" 
							
							<?php 
							if(Auth::user()){
								if($auction->userID == Auth::user()->id){
								echo "disabled";
								}else{
									echo "onclick='$(this).watchProduct(".$auction->userID.",".$auction->productID.", 1)' ";
								}
							}else{echo 'disabled';}?>>
							<span class="glyphicon glyphicon-eye-open">
							</span>&nbsp;Watch this</button>

						<button id="unWatch{{$auction->productID}}" 
							style="background-color:green;" 
							class="btn btn-success unwatchProduct <?php if(!$auction->watched || $auction->watched==0){echo 'hidden';}else{echo ' ';};?>" 
							onclick="$(this).unwatchProduct({{$auction->userID}},{{$auction->productID}})">
							<span class="glyphicon glyphicon-ok">
							</span>&nbsp; Watched </button>
						</div>
					@if(Auth::guest())
					<a>
					@endif
					</div>
					<br>
					<div class="desc-text-prop">
						<center><p>{{$auction->productDescription}}</p></center>
					</div>
					<center>
						<br>
						<button type="button" class="btn btn-success btn-lg show-maxBid maxBid" value="{{$auction->id}}"
							<?php 
							if(Auth::user()){
								if($auction->userID == Auth::user()->id){
								echo "disabled";
								}
							}else{echo 'disabled';}
							?>
						><span class="glyphicon glyphicon-bullhorn"></span>&nbsp; Promote this and Earn<b><font color="#992D31">&nbsp;{{($auction->affiliatePercentage)}}%</font></b> Commission</button>
					</center>
				</div>
			</div>
			<br>
		<hr class="style-fade"></hr>
		<div class="panel panel-primary">
		  <div class="panel-heading">
		    <h3 class="panel-title">Additional Information</h3>
		  </div>
		  <div class="panel-body">
		    <?php if($auction->details != '0'){
				echo $auction->details;
				}
			?>
		  </div>
		</div>
		</div>
	</div>
</div>
</div>
<div class="panel panel-edit square" 
<?php
if(Auth::user()){
	if($auction->userID != Auth::user()->id){
	echo "hidden";
	}
}else{echo "hidden";}
;?>>
	<div class="container">
		<center>
			<a href="{{URL::route('edit-details.edit',$auction->productID)}}"><button class="btn btn-primary"><span class="glyphicon glyphicon-edit">&nbsp</span><span class="error-msg">Let me customize this Sales Page</span></button></a>
		</center>
	</div>
</div>
@endforeach