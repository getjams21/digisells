$(document).ready(function(){
	//get current date
		var today = new Date();
		var dd = today.getDate();
		var mm = today.getMonth()+1; //January is 0!
		var yyyy = today.getFullYear();
		var hour = today.getHours();
		var minutes = today.getMinutes();
		var seconds = today.getSeconds();
		if(dd<10) {
		    dd='0'+dd
		} 

		if(mm<10) {
		    mm='0'+mm
		} 

		today = mm+'-'+dd+'-'+yyyy;
		var currentTime = hour+':'+minutes+':'+seconds;
		// $('#grp-startDate').val(today);
		// $('#startDate').val(today);

	$('.carousel').carousel();

	$('#startDate, #grp-startDate').click(function() {
		$(this).data('date', today);
		$('#grp-startDate').val(today);
		$('#startDate').val(today);
		$(this).datepicker('show');
	});
	$('#endDate, #grp-endDate').click(function() {
		$(this).val('');
		$(this).data('date', today);
		$('#grp-endDate').val(today);
		$('#endDate').val(today);
		$(this).datepicker('show');
	});
	$('#endDate').focus(function() {
		var endDate = $(this).val();
		var expirationDate = endDate+' '+currentTime;
		$(this).val(expirationDate);
	});
	$('#endDate').focusout(function() {
		var endDate = $(this).val();
		var expirationDate = endDate+' '+currentTime;
		$(this).val(expirationDate);
	});
	$('#endDate').change(function() {
		var endDate = $(this).val();
		var expirationDate = endDate+' '+currentTime;
		$(this).val(expirationDate);
	});

	//incrementation selection - changing active buttons

	$('#standard').click(function() {
		$(this).addClass('active');
		$('#customized').removeClass('active');
	});
	$('#customized').click(function() {
		$(this).addClass('active');
		$('#standard').removeClass('active');
	});
	$('#standard').hover(function() {
		$(this).popover('show');
	}, function() {
		$(this).popover('hide');
	});

	//bid price
	$('#standard').click(function() {
		if ($('#MinimumPrice').val() != 0 || $('#MinimumPrice').val() != '') {
			var minPrice = parseFloat($('#MinimumPrice').val());
			var incrementPercentage = minPrice * 0.05;
			var firstBidPrice = minPrice + incrementPercentage;
			//alert('$ '+firstBidPrice.toFixed(2));
			$('#bid-price').text('$'+firstBidPrice.toFixed(2));
			$('.validateMinPrice').hide();
			$('.next-bid-info').show();
		
		}else{
			$('.next-bid-info').hide();
			$('.validateMinPrice').show();
		}
	});
		// $( "#verify-password" ).keyup(function() {
		//   // get password value from first password field
		//   var pwd = $('#password').val();
		//   // get the 2nd password value from the verify password field
		//   var vPwd = $('#verify-password').val();
		//   // verify the values if they are matched
		//   // if matched then show match alert | hide unmatch alert
		//   if (pwd == vPwd) {
		//   		$("#alert-verify-password-ok").removeClass('hide');
		//   		$("#alert-verify-password-remove").addClass('hide');
		//   } // else, show unmatch alert | hide match alert
		//   else {
		//   		$("#alert-verify-password-remove").removeClass('hide');
		//   		$("#alert-verify-password-ok").addClass('hide');
		//   }
		// });
});