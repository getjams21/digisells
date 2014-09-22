<div class="col-md-3 refine-search">
	<h3>Refine Search</h3>
</div>
<div class="container">
	<div class="col-md-3">
	</div>
	<div class="col-md-9" style="background-color:white;">
	@if(Auth::user())
		<input id="currentID" type="text" value="{{Auth::user()->id}}" hidden>
	@endif
		@foreach($listings as $list)
		<?php 
			$originalPrice = $list->price;
			$isDiscounted = false;
			if((float)$list->discount > 0.00){
			$list->price = (float) $list->price - ((float) $list->price * ((float) $list->discount)/100);
			$isDiscounted = true;
			}
		?>
		<div class="modal fade buy-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
		  <div class="modal-dialog modal-sm">
		    <div class="modal-content modal-prop">
			    <center>
					{{ Form::open(['route'=>'sales.store']) }}
						<input type="hidden" name="sellingID" value="{{$list->id}}">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
						<button type="submit" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-check">&nbsp;</span>Confirm Purchase of <font color="#992D31" size="4"><b>${{round($list->price, 2)}}</b></font></button>
					{{ Form::close() }}
				</center>
		      <center><span class="glyphicon glyphicon-ok saved"></span><h4 class="saving"></h4></center>
		    </div>
		  </div>
		</div>
		<!-- End Modal -->
		<br>
		<div class="container-fluid">
			<div class="well listing-prop">
				<div class="container-fluid">
					<div class="col-md-3">
						<div class="thumbnail shadow-default">
							<a href="/direct-selling/{{$list->id}}"><img src="../product/images/{{$list->imageURL}}" class="listing-img-prop"></a>
						</div>
					</div>
					<div class="col-md-9 inactive">
						<a href="/direct-selling/{{$list->id}}"><div class="breadcrumb default-blue shadow-default"><center><h4>{{$list->sellingName}}</h4></center></div></a>
						<p>Affiliate Commission: <font color="#992D31"><b>{{round($list->affiliatePercentage, 2)}}%</b></font></p>
						<p class="comment">{{$list->productDescription}}</p>
						<center>
							<?php 
							if($isDiscounted){
								echo '<p>Original Price: <span class="originalPrice"> <b>$'.round($originalPrice, 2).'</b></span></p>';
							}
						 ?>
						 @if (Session::has('flash_message'))
							<div class="form-group ">
								<p>{{Session::get('flash_message') }}</p>
							</div>
						@endif
					@if(Auth::guest())
					<a href="/login">
					@endif
						<div class="btn-group">
							<button id="btn-buy" class="btn btn-success buy" value="{{$list->id}}"
								<?php 
								if(Auth::user()){
									if($list->userID == Auth::user()->id){
									echo "disabled";}
								}else{echo "disabled";}
								?>
							><span class="glyphicon glyphicon-check"></span>&nbsp;Buy this for
								<font color="#992D31"><b>${{round($list->price, 2)}}</b></font>
							</button>
							<button id="watch{{$list->productID}}" 
								class="btn btn-warning watchProduct <?php if(!$list->watched || $list->watched==0){echo '';}else{echo ' hidden';};?>" 
								<?php 
								if(Auth::user()){
									if($list->userID == Auth::user()->id){
									echo "disabled";
									}else{
										echo "onclick='$(this).watchProduct(".$list->userID.",".$list->productID.", 2)'" ;
									}
								}else{echo "disabled";}
								?>>
								<span class="glyphicon glyphicon-eye-open">
								</span>&nbsp;Watch this</button>

							<button id="unWatch{{$list->productID}}" 
								style="background-color:green;" 
								class="btn btn-success unwatchProduct <?php if(!$list->watched || $list->watched==0){echo 'hidden';}else{echo ' ';};?>" 
								onclick="$(this).unwatchProduct({{$list->userID}},{{$list->productID}})">
								<span class="glyphicon glyphicon-ok">
								</span>&nbsp;Watched </button>
							<button id="btn-promote" class="btn btn-success promote"
								<?php 
								if(Auth::user()){
									if($list->userID == Auth::user()->id){
									echo "disabled";}
								}else{echo "disabled";}
								?>
							><span class="glyphicon glyphicon-bullhorn"></span>&nbsp;Promote this
							</button>
						</div>
					@if(Auth::guest())
					<a>
					@endif
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