<!-- <img src="product/images/{{$product->imageURL}}"> -->

<div class="col-md-12">
	<div class="container">
		<div class="well product-well-prop">
			<div class="container-fluid">
				<div class="col-md-5">
					<div class="thumbnail thumbnail-size shadow-default">
						<img src="product/images/{{$product->imageURL}}" class="product-img-prop">
					</div>
					<div class="panel expiration-date square">
						<center><span>This item is only available until {{$selling->expirationDate}}</span></center>
					</div>
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
					<div class="price">
						<center><span><h2>${{round($selling->price, 2)}}</h2></span></center>
					</div>
					<br>
					<div class="desc-text-prop">
						<center><p>{{$product->productDescription}}</p></center>
					</div>
					<div class="call-to-action">
						<div class="btn-group btn-group-lg btn-group-lg-prop">
						<button class="btn btn-success btn-prop-prod"><span class="glyphicon glyphicon-check">&nbsp;</span>Buy this</button>
						<button class="btn btn-warning btn-prop-prod"><span class="glyphicon glyphicon-eye-open"></span>&nbsp;Watch this</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="panel panel-edit square">
	<div class="container">
		<center>
			<a href="/edit-details/{{$product->id}}"><button class="btn btn-primary"><span class="glyphicon glyphicon-edit">&nbsp</span><span class="error-msg">Let me customize this Sales Page</span></button></a>
			<button class="btn btn-success"><span class="glyphicon glyphicon-check">&nbsp</span><span class="error-msg">I'm okay with this</span></button>
		</center>
	</div>
</div>
