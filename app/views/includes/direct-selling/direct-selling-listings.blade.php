<div class="col-md-3 refine-search">
	<h3>Refine Search</h3>
</div>
<div class="container">
	<div class="col-md-3">
	</div>
	<div class="col-md-9" style="background-color:white;">
		<input id="currentID" type="text" value="{{Auth::user()->id}}" hidden>
		@foreach($listings as $list)
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
						<p class="comment">{{$list->productDescription}}</p>
						<center>
						<div class="btn-group">
							<button class="btn btn-success buy" value="{{$list->id}}"
								<?php if($list->userID == Auth::user()->id){
									echo "disabled";
								};?>
							><span class="glyphicon glyphicon-check"></span>&nbsp;Buy this for
								<font color="#992D31"><b>${{round($list->price, 2)}}</b></font>
							</button>
							<button id="watch{{$list->productID}}" 
								class="btn btn-warning watchProduct <?php if(!$list->watched || $list->watched==0){echo '';}else{echo ' hidden';};?>" 
								onclick="$(this).watchProduct({{$list->userID}},{{$list->productID}}, 1)" 
								<?php if($list->userID == Auth::user()->id){
									echo "disabled";
								};?>>
								<span class="glyphicon glyphicon-eye-open">
								</span>&nbsp;Watch this</button>

							<button id="unWatch{{$list->productID}}" 
								style="background-color:green;" 
								class="btn btn-success unwatchProduct <?php if(!$list->watched || $list->watched==0){echo 'hidden';}else{echo ' ';};?>" 
								onclick="$(this).unwatchProduct({{$list->userID}},{{$list->productID}})">
								<span class="glyphicon glyphicon-ok">
								</span>&nbsp;Watched </button>
						</div>
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