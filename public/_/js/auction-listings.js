$(document).ready(function() {
	//auction countdown
	var endDate = $('#endingDate').val();
	var auction_ID = $('#auction-id').val();
	var path = '/auction-listing';
	if($('#isShow').val == '1'){
		var path = '../auction-listing';
	}
	$('.countdown.default').countdown({
          date: endDate,
          render: function(data) {
            $(this.el).html("<div>"+this.leadingZeros(data.days, 2)+" days and \
            	"+this.leadingZeros(data.hours, 2)+":\
            	"+this.leadingZeros(data.min, 2)+":\
            	"+this.leadingZeros(data.sec, 2)+" left </div>");
          },
          onEnd: function() {
           $.get(path+'/'+auction_ID+'/edit',{},function(data){
			if(data)
	            {
					$('.countdown.default')
					.find('div')
					.remove()
					.end();
					$('.countdown.default').append('<div class="alert alert-danger" role="alert">\
							This auction has ended on '+data+'\
							<br>\
							<center><button class="btn btn-success" value="'+auction_ID+'"><font size="2" color="white">View auction result</font></button></center>\
						</div>');
					$('.bid,.maxBid,.watchProduct,.unwatchProduct,.buyout').attr({
						'disabled': 'disabled'
					});
				}
			});
          }
    });
    $('.countdown.styled').countdown({
          date: endDate,
          render: function(data) {
            $(this.el).html(+this.leadingZeros(data.days, 2)+" days and \
            	"+this.leadingZeros(data.hours, 2)+":\
            	"+this.leadingZeros(data.min, 2)+":\
            	"+this.leadingZeros(data.sec, 2)+" left");
          },
          onEnd: function() {
            $(this.el).addClass('ended');
          }
    });
});