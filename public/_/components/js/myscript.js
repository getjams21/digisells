//file browser
$(document).on('change', '.btn-file :file', function() {
  var input = $(this),
      numFiles = input.get(0).files ? input.get(0).files.length : 1,
      label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
  input.trigger('fileselect', [numFiles, label]);
});

$(document).ready(function(){
	//file browser display file name
	$('.btn-file :file').on('fileselect', function(event, numFiles, label) {
        
        var input = $(this).parents('.input-group').find(':text'),
            log = numFiles > 1 ? numFiles + ' files selected' : label;
        
        if( input.length ) {
            input.val(log);
        } else {
            if( log ) alert(log);
        }
        
    });

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

	$('#customized').hover(function() {
		$(this).popover('show');
	}, function() {
		$(this).popover('hide');
	});
	$('#affiliation').hover(function() {
		$(this).popover('show');
	}, function() {
		$(this).popover('hide');
	});
	//bid price
	function calculateStandardIncrementation(){
		if ($('#MinimumPrice').val() != 0 || $('#MinimumPrice').val() != '') {
			var minPrice = parseFloat($('#MinimumPrice').val());
			var incrementPercentage = minPrice * 0.05;
			var firstBidPrice = minPrice + incrementPercentage;
			//alert('$ '+firstBidPrice.toFixed(2));
			$('#bid-price').text('$'+firstBidPrice.toFixed(2));
			$('.validateMinPrice').hide();
			$('.customized-bid').hide();
			$('.next-bid-info').show();
		
		}else{
			$('.next-bid-info').hide();
			$('.validateMinPrice').show();
		}
	}
	function calculateCustomizedIncrementation(incVal){
		if ($('#MinimumPrice').val() != 0 || $('#MinimumPrice').val() != '') {
			var incValue = parseFloat(incVal);
			var minPrice = parseFloat($('#MinimumPrice').val());
			var firstBidPrice = parseFloat(incValue + minPrice);
			$('#customBid').text('$'+firstBidPrice.toFixed(2));
			$('.validateMinPrice').hide();
			$('.next-bid-info').hide();
			$('.customized-bid').show();
		}else {
			$('.customized-bid').hide();
			$('.validateMinPrice').show();
		}
	}
	$('#customized').click(function() {
		var incVal = parseFloat($('#bidIncrement').val());
		calculateCustomizedIncrementation(incVal);
	});

	$('#standard').click(function() {
		calculateStandardIncrementation();
	});
	$('#MinimumPrice').keyup(function() {
		if($('#standard').hasClass('active')) {
			calculateStandardIncrementation();
		}else {
			var incVal = parseFloat($('#bidIncrement').val());
			calculateCustomizedIncrementation(incVal);
		}
	});
	$('#bidIncrement').keyup(function() {
		var incVal;
		if($('#bidIncrement').val() == '') {
				incVal = 0.01;
				//$('#bidIncrement').val(incVal);
				//incVal = $('#bidIncrement').val();
			} else {
				incVal = $('#bidIncrement').val();
			}
		calculateCustomizedIncrementation(incVal);
	});

	$('#bidIncrement').change(function() {
		if($('#bidIncrement').val() == '' || $('#bidIncrement').val() == 0) {
				var incVal = 0.01;
				$('#bidIncrement').val(incVal);
				incVal = $('#bidIncrement').val();
			} else {
				incVal = $('#bidIncrement').val();
			}
		calculateCustomizedIncrementation(incVal);
	});
	//affiliation properties

	$('#affiliation').click(function() {
		$('.validateAffOption').hide();
		$('.affiliation').show();
		$(this).hide();
	});
	$('#disableAffiliation').click(function() {
		$('.validateAffOption').show();
		$('.affiliation').hide();
		$('#affiliation').show();
	});

	//disable submit button and invalid file alert
	$('#SubmitButton').prop('disabled', true);
	$('#fileName').attr('disabled', true);
	//validate Image file
	$('#fileUpload').click(function() {
		$('#fileName').attr('disabled', false);
		$('#fileName').focus();
	});
	$('#fileName').blur(function() {
		//alert($(this).val());
		var filename = $(this).val();
		switch(filename.substring(filename.lastIndexOf('.')+1).toLowerCase()){
			case 'gif': case 'jpg': case 'png': case 'bmp':
				$('#SubmitButton').prop('disabled', false);
				$('.validateImage').hide();
				break;
			default:
				$('.validateImage').show();
		}
	});

	//trigger to click modal toggler
	$('#SubmitButton').click(function() {
		$('#showUploadModal').trigger('click');
	});

	//File upload modal
	$('#showModal').click(function() {
		$('#myModal').modal('show');
	});

	//Upload Progress...
        var progressbar     = $('#progressbar');
        var statustxt       = $('#statustxt');
        var submitbutton    = $("#SubmitButton");
        var myform          = $("#fileupload");
        var saving			= $('.saving');
        var saved			= $('.saved');
        var completed       = '0%';
 
                $(myform).ajaxForm({
                    beforeSend: function() { //brfore sending form
                        submitbutton.attr('disabled', ''); // disable upload button
                        statustxt.empty();
                        progressbar.css({
                        	width: completed
                        });; //initial value 0% of progressbar
                        //statustxt.html(completed); //set status text
                        statustxt.css('color','#000'); //initial color of status text
                    },
                    uploadProgress: function(event, position, total, percentComplete) { //on progress
                        progressbar.css({
                        	width: percentComplete + '%'
                        });; //update progressbar percent complete
                        statustxt.css({
                        	html: percentComplete + '%'
                        }); //update status text
                        if(percentComplete>50)
                            {
                                statustxt.css('color','#fff'); //change status text to white after 50%
                            }
                        },
                    complete: function(response) { // on complete
                        statustxt.css({
                        	html:'100%'
                        });
                        saving.css({
                        	display: 'none'
                        });
                        saved.css({
                        	display: 'block'
                        });
                        //myform.resetForm();  // reset form
                        submitbutton.removeAttr('disabled'); //enable submit button
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