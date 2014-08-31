$(document).ready(function() {
	$(window).scroll(function()
		{
	     if($(window).scrollTop() + $(window).height() > $(document).height() - 100)
	    {
			// alert('down');
			$('div.loading').show();
			setTimeout(function(){
             	$('div.lists').show();
             	$.post('load-more-auction',{},function(data){
					if(data)
		            {                 
						$.each(data, function(key,value) {
						var minimumPrice = Math.round(value.minimumPrice*100)/100;
						var buyoutPrice = Math.round(value.buyoutPrice*100)/100;
						  $(".lists").append('\
						  	<div class="well">\
						  		<div class="container-fluid">\
						  			<div class="col-md-3">\
						  				<div class="thumbnail shadow-default">\
						  					<img src="../product/images/'+value.imageURL+'" class="listing-img-prop">\
						  				</div>\
						  			</div>\
						  			<div class="col-md-9">\
										<h4>'+value.auctionName+'</h4>\
										<h5><b>Starting Bid: <font color="#992D31">$'+minimumPrice+'</font></b></h5>\
										<p>'+value.productDescription+'</p>\
										<div class="btn-group">\
											<button class="btn btn-primary"><span class="glyphicon glyphicon-bell"></span>&nbsp;Bid for this</button>\
											<button class="btn btn-success"><span class="glyphicon glyphicon-check"></span>&nbsp;Buy this for <font color="#992D31"><b>$'+buyoutPrice+'</font></b></button>\
											<button class="btn btn-warning"><span class="glyphicon glyphicon-eye-open"></span>&nbsp;Watch this</button>\
										</div>\
									</div>\
						  		</div>\
						  	</div>\
						  	');
						}); 
		                $('div.loading').hide();
		            }else
		            {
		                $('div.loading').html('<center>End of Listings.</center>');
		            }
			      });
            },1500);
        }
	});
});