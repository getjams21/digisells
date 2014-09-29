<div class="col-md-12">
	<div class="container">
		<div class="well product-well-prop">
			<div class="container-fluid">
				<div class="col-md-5">
					<div class="thumbnail thumbnail-size shadow-default">
						<img src="../product/images/{{$product->imageURL}}" class="product-img-prop">
					</div>
					<center><button class="btn btn-success btn-lg"><span class="glyphicon glyphicon-check">&nbsp;</span>Buy this for ${{round($auction->buyoutPrice, 2)}}</button></center>
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
						<center><span>This auction will end on
							{{
								date("d F Y",strtotime($auction->endDate)) }} at {{ date("g:ha",strtotime($auction->endDate));
							}}
						</span></center>
					</div>
					<div class="well well-bid">
						<center><div class="price">
							<span><h2>Starting Bid: &nbsp;${{round($auction->minimumPrice, 2)}}</h2></span>
						</div>
						<span>Enter Bid ${{round($auction->minimumPrice, 2)}} or higher</span>
						<div class="input-group txtbox-s prop-s">
		                    <span class="input-group-addon">$</span>
		                    <input class="form-control span3" placeholder="Bid Price" id="bidPrice" required="required" name="bidPrice" type="text" value="">         
	                	</div>
	                	<div class="btn-group">
						<button class="btn btn-primary"><span class="glyphicon glyphicon-bell">&nbsp;</span>Place Bid</button>
						<button class="btn btn-warning"><span class="glyphicon glyphicon-eye-open"></span>&nbsp;Watch this</button>
						</div>
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
			<a href="{{URL::route('edit-details.edit',$auction->productID)}}"><button class="btn btn-primary"><span class="glyphicon glyphicon-edit">&nbsp</span><span class="error-msg">Let me customize this Sales Page</span></button></a>
		</center>
	</div>
</div>
