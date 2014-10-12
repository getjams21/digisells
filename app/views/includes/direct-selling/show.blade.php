@foreach($sellingEvent as $selling)
<!-- Modal for Saving and Uploading -->
<?php 
	$originalPrice = $selling->price;
	$isDiscounted = false;
	if((float)$selling->discount > 0.00){
	$selling->price = (float) $selling->price - ((float) $selling->price * ((float) $selling->discount)/100);
	$isDiscounted = true;
	}
?>
<!-- buy modal -->
<div class="modal fade buy-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-sm">
    <div class="modal-content modal-prop">
	    <center>
			{{ Form::open(['route'=>'sales.store']) }}
				<input type="hidden" name="sellingID" value="{{$selling->id}}">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
				<button type="submit" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-check">&nbsp;</span>Confirm Purchase of <font color="#992D31" size="4"><b>${{round($selling->price, 2)}}</b></font></button>
			{{ Form::close() }}
		</center>
      <center><span class="glyphicon glyphicon-ok saved"></span><h4 class="saving"></h4></center>
    </div>
  </div>
</div>
<!-- End buy Modal -->
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
<div class="col-md-12">
	<div class="container">
		<div class="well product-well-prop">
			<div class="container-fluid">
				<div class="col-md-5">
					<div class="thumbnail thumbnail-size shadow-default">
						<img src="../product/images/{{$selling->imageURL}}" class="product-img-prop">
					</div>
					<center>
						<?php 
							if($isDiscounted){
								echo '<p>Original Price: <span class="originalPrice"> <b>$'.round($originalPrice, 2).'</b></span></p>';
							}
						 ?>
						<button id="btn-buy" class="btn btn-success btn-lg buy"
							<?php 
							if(Auth::user()){
								if($selling->userID == Auth::user()->id){
								echo "disabled";
								}
							}else{echo "disabled";}
							;?>
						><span class="glyphicon glyphicon-check">&nbsp;</span>Buy this for <font color="#992D31" size="4"><b>${{round($selling->price, 2)}}</b></font></button>
					</center>
				</div>
				<div class="col-md-7">
					<div class="breadcrumb brd-prod-name shadow-default">
						<center>
							<span>{{$selling->sellingName}}</span>
						</center>
					</div>
					<div class="reviews">
						<center><p><input id="input-5a" class="rating" data-readonly="true" data-size="xs" data-show-clear="false" data-show-caption="true" value="<?php
							if($selling->stars == NULL){
								echo '0';
							}else{
								echo $selling->stars;
							}
						?>"> </center>
					</div>
					<div class="panel expiration-date square">
						<center><span>This listing is available until
							{{
								date("d F Y",strtotime($selling->expirationDate)) }} at {{ date("g:ha",strtotime($selling->expirationDate));
							}}
						</span></center>
					</div>
				</div>
					<br>
					<div class="desc-text-prop">
						<center><p>{{$selling->productDescription}}</p></center>
					</div>
				<center>	
				<div class="input-group prop-s">
					<div class="btn-group">	
						<button type="button" id="watch{{$selling->productID}}" 
						class="btn btn-warning watchProduct <?php if(!$selling->watched || $selling->watched==0){echo '';}else{echo ' hidden';};?>" 
						onclick="$(this).watchProduct({{$selling->userID}},{{$selling->productID}}, 1)" 
						<?php 
						if(Auth::user()){
							if($selling->userID == Auth::user()->id){
							echo "disabled";
							}else{
								echo "onclick='$(this).watchProduct(".$selling->userID.",".$selling->productID.", 1)'' ";
							}
						}else{echo "disabled";}
						;?>>
						<span class="glyphicon glyphicon-eye-open">
						</span>&nbsp;Watch this</button>
						<button type="button" id="unWatch{{$selling->productID}}" 
							style="background-color:green;" 
							class="btn btn-success unwatchProduct <?php if(!$selling->watched || $selling->watched==0){echo 'hidden';}else{echo ' ';};?>" 
							onclick="$(this).unwatchProduct({{$selling->userID}},{{$selling->productID}})">
							<span class="glyphicon glyphicon-ok">
							</span>&nbsp; Watched </button>
						<input type="hidden" id="isSelling" value="1">	
						<button type="submit" id="btn-promote" class="btn btn-success promote" name="promote-selling" value="{{$selling->id}}"
								<?php 
								if(Auth::user()){
									if($selling->userID == Auth::user()->id){
									echo "disabled";}
								}else{echo "disabled";}
								?>
							><span class="glyphicon glyphicon-bullhorn"></span>&nbsp;Promote this and Earn <font color="#992D31"><b>{{round($selling->affiliatePercentage, 2)}}%</b></font> Commission
							</button>
					</div>
				</div>
				</center>
			</div>
			<br>
			<hr class="style-fade"></hr>
			<div class="panel panel-primary">
			  <div class="panel-heading">
			    <h3 class="panel-title">Additional Information</h3>
			  </div>
			  <div class="panel-body">
			    <?php if($selling->details != '0'){
					echo $selling->details;
					}
				?>
			  </div>
			</div>
		</div>
	</div>
</div>
<div class="panel panel-edit square" 
<?php
if(Auth::user()){
	if($selling->userID != Auth::user()->id){
	echo "hidden";
	}
}else{echo "hidden";}
;?>>
	<div class="container">
		<center>
			<a href="{{URL::route('edit-details.edit',$selling->productID)}}"><button class="btn btn-primary"><span class="glyphicon glyphicon-edit">&nbsp</span><span class="error-msg">Let me customize this Sales Page</span></button></a>
		</center>
	</div>
</div>
@endforeach