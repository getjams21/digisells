$(document).ready(function() {
	// alert('down');
	 	$('.load-more').click(function(event) {
	 		$('#loading-img').show();
	 		setTimeout(function(){
	 		$('div.lists').show();
	     	$.post('load-more-auction',{},function(data){
				if(data)
	            {                 
					$.each(data, function(key,value) {
					var minimumPrice = Math.round(value.minimumPrice*100)/100;
					var buyoutPrice = Math.round(value.buyoutPrice*100)/100;
					  $(".lists").append('\
					  	<div class="well listing-prop">\
					  		<div class="container-fluid">\
					  			<div class="col-md-3">\
					  				<div class="thumbnail shadow-default">\
					  					<a href="/auction-listing/'+value.id+'"><img src="../product/images/'+value.imageURL+'" class="listing-img-prop"></a>\
					  				</div>\
					  			</div>\
					  			<div class="col-md-9">\
					  				<a href="/auction-listing/'+value.id+'"><div class="breadcrumb default-blue"><center><h4>'+value.auctionName+'</h4></center></div></a>\
									<h5><b>Starting Bid: <font color="#992D31">$'+minimumPrice+'</font></b></h5>\
									<p class="desc">'+value.productDescription+'</p>\
									<center>\
									<div class="btn-group">\
										<button class="btn btn-primary bid" value="'+value.id+'"><span class="glyphicon glyphicon-bell"></span>&nbsp;Bid for this</button>\
										<button class="btn btn-success"><span class="glyphicon glyphicon-check"></span>&nbsp;Buy this for <font color="#992D31"><b>$'+buyoutPrice+'</font></b></button>\
										<button class="btn btn-warning"><span class="glyphicon glyphicon-eye-open"></span>&nbsp;Watch this</button>\
									</div>\
									</center>\
								</div>\
					  		</div>\
					  	</div>\
					  	');
					});
				$(".desc").shorten({
			    "showChars" : 150,
			    "moreText"  : "Read More >>",
			    "lessText"  : "<< Less",
				});
				$('#loading-img').hide();
	            }else
	            {
	                $('div.loading').html('<center>- End of Listings -</center>');
	            }
		    });
			},1500);
		});
});