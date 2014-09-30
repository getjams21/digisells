<br>
<br>
<div class="container">
	<div class="col-md-8 col-md-offset-2">
		<div class="panel panel-warning">
		  <div class="panel-heading">
		    <h3 class="panel-title">My Feedback and Review for <font color="#428bca"><b>{{$product->productName}}</b></font></h3>
		  </div>
		  <div class="panel-body">
		    {{ Form::open(['route'=>'product-review.store']) }}
		    	<div class="form-group">
			    	<div class="reviews">
			    		<textarea name="review" class="form-control" rows="4" placeholder="What can I can say about this product..."></textarea>
			    		<br>
			    		<center><label for="input-5a">I'll give it...</label>
						<input name="star" id="input-5a" class="rating" data-readonly="false" data-size="xs" data-show-clear="false" data-show-caption="true" value="0">
						<br>
						<button type="submit" class="btn btn-warning" name="productID" value="{{$product->id}}">Place my review...</button>
						</center>

					</div>
				</div>
		    {{ Form::close() }}
		  </div>
		</div>
	</div>
</div>