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
<!-- End Modal -->
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
						<button id="btn-buy" class="btn btn-success btn-lg"
							<?php if($selling->userID == Auth::user()->id){
								echo "disabled";
								};?>
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
						<center><p><input id="input-5a" class="rating" data-readonly="true" data-size="xs" data-show-clear="false" data-show-caption="true" value="0">&nbsp;No Customer Reviews</p> </center>
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
						<button type="button" id="watch{{$selling->productID}}" 
						class="btn btn-warning watchProduct <?php if(!$selling->watched || $selling->watched==0){echo '';}else{echo ' hidden';};?>" 
						onclick="$(this).watchProduct({{$selling->userID}},{{$selling->productID}}, 1)" 
						<?php if($selling->userID == Auth::user()->id){
							echo "disabled";
						};?>>
						<span class="glyphicon glyphicon-eye-open">
						</span>&nbsp;Watch this</button>
						<button type="button" id="unWatch{{$selling->productID}}" 
							style="background-color:green;" 
							class="btn btn-success unwatchProduct <?php if(!$selling->watched || $selling->watched==0){echo 'hidden';}else{echo ' ';};?>" 
							onclick="$(this).unwatchProduct({{$selling->userID}},{{$selling->productID}})">
							<span class="glyphicon glyphicon-ok">
							</span>&nbsp; Watched </button>	
				</div>
				</center>
			</div>
		</div>
	</div>
</div>
@endforeach