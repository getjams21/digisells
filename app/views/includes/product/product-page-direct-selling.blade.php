<!-- <img src="product/images/{{$product->imageURL}}"> -->

<div class="col-md-12">
	<div class="container">
		<div class="well product-well-prop">
			<div class="container-fluid">
				<div class="col-md-5">
					<div class="thumbnail thumbnail-size shadow-default">
						<img src="product/images/{{$product->imageURL}}" class="product-img-prop">
					</div>
				</div>
				<div class="col-md-7">
					<div class="breadcrumb brd-prod-name shadow-default">
						<center>
							<span>{{$selling->sellingName}}</span>
						</center>
					</div>
					<div class="reviews">
						<center><p><input id="input-5a" class="rating" data-readonly="false" data-size="xs" data-show-clear="false" data-show-caption="true" value="0">&nbsp;No Customer Reviews</p> </center>
					</div>
					<div class="price">
						<center><span><h2>${{round($selling->price, 2)}}</h2></span></center>
					</div>
					<br>
					<div class="desc-text-prop">
						<center><p>{{$product->productDescription}}</p></center>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>