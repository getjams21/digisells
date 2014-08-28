//file browser
$(document).on('change', '.btn-file :file', function() {
  var input = $(this),
      numFiles = input.get(0).files ? input.get(0).files.length : 1,
      label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
  input.trigger('fileselect', [numFiles, label]);
});

$(document).ready(function(){
	// $.ajaxSetup({
	//     headers: {
	//         'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
	//     }
	// });
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

	//Disable Submit Button
	$('#SubmitButton').prop('disabled', true);
	//Show Error Message
	function displayError(errorMsg){
		$('.error-msg').text(errorMsg);
		$('.error-panel').animate({
			opacity: '1', 
			width: '100%'
		}, 300)
	}
	//Hide Error Message
	function hideError(){
		$('.error-msg').text('');
		$('.error-panel').animate({
			opacity: '0', 
			width: '0%'
		}, 300)
	}
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

	//validate Auction Starting Date
	$('#startDate').change(function(event) {
		var dateValue = $(this).val();
		if(dateValue<today){
			$('#SubmitButton').prop('disabled', true);
			displayError('Invalid Date! Starting Date must not be a PAST date.');
		}else{
			$('#SubmitButton').prop('disabled', false);
			hideError();
		}
	});
	//validate Auction End Date
	$('#endDate').change(function(event) {
		var dateValue = $(this).val();
		//alert(dateValue);
		if(dateValue<=today+' '+currentTime){
			$('#SubmitButton').prop('disabled', true);
			displayError('Invalid Date! End Date must not be a PAST or a CURRENT date.');
		}else{
			$('#SubmitButton').prop('disabled', false);
			hideError();
		}
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
		if ($('#MinimumPrice').val() != '') {
			var minPrice = parseFloat($('#MinimumPrice').val());
			if(minPrice != 0){
                var incrementPercentage = minPrice * 0.05;
				var firstBidPrice = minPrice + incrementPercentage;
				$('#bid-price').text('$'+firstBidPrice.toFixed(2));
				$('.customized-bid').hide();
				$('.next-bid-info').show();
			}else{
				$('.next-bid-info').hide();
				displayError('Minimum Price must NOT be 0');
			}
		}else{
			$('.next-bid-info').hide();
			displayError('Minimum Price must NOT be EMPTY!');
		}
	}
	function calculateCustomizedIncrementation(incVal){
		var minPrice = $('#MinimumPrice').val();
		hideError();
		if (minPrice != '') {
			if(minPrice != 0){
                var incValue = parseFloat(incVal);
				minPrice = parseFloat(minPrice);
				var firstBidPrice = parseFloat(incValue + minPrice);
				$('#customBid').text('$'+firstBidPrice.toFixed(2));
				$('.next-bid-info').hide();
				$('.customized-bid').show();
			}else{
				displayError('Minimum Price must NOT be 0');
			}
		}else {
			$('.customized-bid').hide();
			displayError('Minimum Price must NOT be EMPTY');
		}
	}
	$('#customized').click(function() {
		var incVal = parseFloat($('#bidIncrement').val());
		calculateCustomizedIncrementation(incVal);
	});

	$('#standard').click(function() {
		calculateStandardIncrementation();
	});
	$('#MinimumPrice').keyup(function(event) {
		// Allow special chars + arrows 
        if (event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 
            || event.keyCode == 27 || event.keyCode == 13 
            || (event.keyCode == 65 && event.ctrlKey === true) 
            || (event.keyCode >= 35 && event.keyCode <= 39)){
        	hideError();
                return;
        }else {
            // If it's not a number stop the keypress
            if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
                displayError('Only Numbers are accepted');
                event.preventDefault();
            }   
	        if($('#standard').hasClass('active')) {
				calculateStandardIncrementation();
			}else {
				var incVal = parseFloat($('#bidIncrement').val());
				calculateCustomizedIncrementation(incVal);
			}
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

	$('#fileName').attr('disabled', true);
	//validate Image file
	$('#fileUpload').click(function() {
		this.value = null;
	});
	$('#fileUpload').change(function() {
		var filename = $(this).val();
		//var fileLength = $(this).get(0).files.length;
		var fileSize = $(this).get(0).files[0].size;
    	var maxSize = $(this).data('max-size');
    	// fileSize = 5000001;
    	if(fileSize<=maxSize){
    		hideError();
    		switch(filename.substring(filename.lastIndexOf('.')+1).toLowerCase()){
			case 'gif': case 'jpg': case 'png': case 'bmp':
				// $('#SubmitButton').prop('disabled', false);
				$('#SubmitButton').prop('disabled', false);
				$('#submitSelling').prop('disabled', false);
				hideError();
				break;
			default:
				$('#submitSelling').prop('disabled', true);
				$('#SubmitButton').prop('disabled', true);
				displayError('Invalid File Format! Please select an Image file (.png, .jpg, .gif or .bmp).');
			}
    	}else{
    		displayError('File size limit exceeded! Please select or resize the Image to at least 5MB.')
    	}
	});
	// Copyright File Upload
	$('#copyrightFileUpload').click(function() {
		this.value = null;
	});
	$('#copyrightFileUpload').change(function() {
		var filename = $(this).val();
		switch(filename.substring(filename.lastIndexOf('.')+1).toLowerCase()){
			case 'zip': case 'rar':
				$('#SubmitButton').prop('disabled', false);
				$('#submitSelling').prop('disabled', false);
				hideError();
				break;
			default:
				$('#SubmitButton').prop('disabled', true);
				$('#submitSelling').prop('disabled', true);
				displayError('Invalid File Format! Please compress your file first (.zip or .rar).');
		}
	});

	//Product Upload
	$('#productUpload').hover(function() {
		$(this).popover('show');
	}, function() {
		$(this).popover('hide');
	});

	//Product Download Link
	$('#downloadLink').hover(function() {
		$(this).popover('show');
	}, function() {
		$(this).popover('hide');
	});

	//Provide Product Options
	$('#productUpload').click(function() {
		$(this).addClass('active');
		$('#downloadLink').removeClass('active');
		$('.downloadLink').hide();
		$('.uploadProduct').show();
	});
	$('#downloadLink').click(function() {
		$(this).addClass('active');
		$('#productUpload').removeClass('active');
		$('.uploadProduct').hide();
		$('.downloadLink').show();
	});

	//validate Download Link
	$('#download-Link').change(function(event) {
		var url = $(this).val();
		if(url.substr(0,7) != 'http://'){
			$('#SubmitButton').prop('disabled', true);
		    displayError('Invalid URL! Download link must start with http://');
		}else{
			$('#SubmitButton').prop('disabled', true);
			hideError();
		}
	});

	//Category Selection
	$('#selectCategory').change(function(event) {
		var val = $(this).val();
		$.post('fetchSubCategory',{val:val},function(data){
		//removing currrent options on select
		$('#subCategory')
		.find('option')
		.remove()
		.end();
		//populating the new options on select
   		$.each(data, function(key, value) {   
	        $('#subCategory')
	        	.append(
	            $('<option/>').val( key ).text( value )
	        );
	    });
      });
	});

	//number only input
	function numberOnlyInput(e){
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) || 
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
      	}
	}

	//quantity number only input
	$("#qty").keydown(function (e) {
		// var input = $(this).val();
		numberOnlyInput(e);
	});
	//affiliate percentage
	$("#affiliatePercentage").keydown(function(e){
		numberOnlyInput(e);
	});
	//customized bid number only input
	$("#bidIncrement").keydown(function(e){
		numberOnlyInput(e);
	});
	$("#MinimumPrice").keydown(function(e){
		numberOnlyInput(e);
	});
	$("#buyoutPrice").keydown(function(e){
		numberOnlyInput(e);
	});
	$("[name='amount']").keydown(function(e){
		numberOnlyInput(e);
	});
	$("[name='amount']").blur(function() {
                var amt = parseFloat(this.value);
                $(this).val(amt.toFixed(2));
    });
	$("#cvv2").keydown(function(e){
		numberOnlyInput(e);
	});
	$("#cardNumber").keydown(function(e){
		numberOnlyInput(e);
	});
	$('#productPrice,#discountPrice,#affiliatePercentage').keydown(function(event) {
		numberOnlyInput(event);
	});

	//Direct Selling - Product Info (step 1)
	$('.step-1,.step-2,.step-3').animate({
		width: '100%',
		opacity: 1
	}, 800);
	$('#btn-step-1,#btn-step-2-back').click(function(event) {
		parent.history.back();
		return false;
	});


	  //   $('#start_date').change(function(){
	  //       $('#end_date').val(AddDays());
	  //   });

//Auction Upload Progress...
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
                    	setTimeout(function(){
                    		window.location = "http://digisells.com/sales-page/default";
                    	},1500);
                    }
            });
//Direct Selling Upload Progress
 		var progressbar     = $('#progressbar');
        var statustxt       = $('#statustxt');
        var submitbutton    = $("#SubmitButton");
        var myform          = $("#directSelling");
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
                    	setTimeout(function(){
                    		window.location = "http://digisells.com/sales-page-default";
                    	},1500);
                    }
            });
//change body tag with its meta-title
	var a = document.title;
	document.getElementsByTagName("body")[0].id = a;
	if(a == 'Login'){
		$('.nav-dropdown').hide();	
		$("#Login a:contains('Login')").parent().addClass('active');
	}else{
//navigation automatic dropdown
		$('ul.nav li.dropdown').hover(function() {
			$('.dropdown-menu', this).fadeIn();
		}, function() {
			$('.dropdown-menu', this).fadeOut('fast');
		});
	}
//set active navbar
	$("#"+a+" a:contains('"+a+"')").parent().addClass('active');
	$("#Edit a:contains('Profile')").parent().addClass('active');
//set active sidebar
		$("#"+a+" a:contains("+a+")").parent().addClass('active');
		$(".sidehead ul:contains("+a+")").removeClass('collapse');
//password validation
//color variables
	var goodColor = "#66cc66";
   	var badColor = "#FFE6BB";
   	var softGood = "#C3FDB8";
   	var badText = "red";
//password_confirmation keyup validations
		$('#password_confirmation').keyup(function(){
		   passwordValidation();
		});
//password keyup validations
		$('#password').keyup(function(){
		  passwordValidation();
		});
//password validation function
	function passwordValidation(){
		    var pass1 = document.getElementById('password');
		    var pass = pass1.value;
		    var pass2 = document.getElementById('password_confirmation');
		    var message = document.getElementById('confirmMessage');
		    var message2 = document.getElementById('confirmMessage2');
		    if((pass.length >= 6) && (pass.length <= 20))
		    {
		    	message.innerHTML = " "
			 	if(pass1.value == pass2.value){
			 		pass1.style.backgroundColor = softGood;
			        pass2.style.backgroundColor = goodColor;
			        message2.style.color = goodColor;
			        message2.innerHTML = "Passwords Match!"
			    }else{
			     	pass1.style.backgroundColor = badColor;
			        pass2.style.backgroundColor = badColor;
			        message2.style.color = badText;
			        message2.innerHTML = "Passwords Does Not Match!"
			    }
			}else{
					pass2.style.backgroundColor = badColor;
					message2.innerHTML = " "
					pass1.style.backgroundColor = badColor;
			        message.style.color = badText;
			        message.innerHTML = "Passwords Must be 6 to 20 characters only!"
			}
	}
//username validation start
  $('#username').on('blur', function(e){ 
      e.preventDefault(); 
      
      var username = $('#username').val();
 	  $.post('searchUser',{username: username},function(data){
      		//Gandang gabi vice :D
   			 var usernamebox = document.getElementById('username');
   			 var message = document.getElementById('searchMessage');
   			 var length = username.length;
   			 if(data == 0){
   			 	if(length <= 2 ){
   			 		usernamebox.style.backgroundColor = badColor;
			        message.style.color = badText;
			        message.innerHTML = "Must consist 3 or more characters!"
   			 	}else{
			        usernamebox.style.backgroundColor = softGood;
			        message.style.color = goodColor;
			        message.innerHTML = "Username Available"
			     }   
		    }else if(data == 1){
		        usernamebox.style.backgroundColor = badColor;
		        message.style.color = badText;
		        message.innerHTML = "Username Taken!"
		    }
      });
    }); //end of username validation

//email validation start
    $('#email').on('blur', function(e){ 
      e.preventDefault();
      var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
   	  var emailbox = document.getElementById('email');
   	  var message = document.getElementById('searchEmail');
      var email = $('#email').val();
      //if email is valid or not
       if (!filter.test(emailbox.value)) {
		    	emailbox.style.backgroundColor = badColor;
			    message.style.color = badText;
			    message.innerHTML = "Invalid Email Address!"
		    email.focus;
		    return false;
	    }else{
		 	  $.post('searchEmail',{email: email},function(data){
		      		//Gandang gabi vice :D
					if(data == 0)
		   			{
					    emailbox.style.backgroundColor = softGood;
					    message.style.color = goodColor;
					    message.innerHTML = "Email Available"
					}else{
				        emailbox.style.backgroundColor = badColor;
				        message.style.color = badText;
				        message.innerHTML = "Email Taken!"
				    }
		      });
	 		}
    }); //end of email validation
//CLICKABLE TABLE ROW
$(".clickableRow").click(function() {
            window.document.location = $(this).attr("href");
      });
//end
 $("#sidebar-wrapper").hover(function(e) {
	        e.preventDefault();
	        $("#wrapper").addClass("toggled");
	    }, function() {
		$("#wrapper").removeClass('toggled');
	});
// IMAGE UPLOAD PREVIEW FUNCTION
	function readURL(input) {

	    if (input.files && input.files[0]) {
	        var reader = new FileReader();

	        reader.onload = function (e) {
	            $('#default').attr('src', e.target.result);
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
	}
//USER IMAGE UPLOAD PREVIEW EVENT
	$("#userImage").change(function(){
	    readURL(this);
	});

//SIDEBAR CLICK COLLAPSE
	$('.sidehead').click(function() {
			$(this).children('ul').first().stop(true, true).slideToggle(500);;
		});

//submit validation. Don't eput codes next to it. this must
//be the last codes.
	//Direct Selling Submit
	$('#submitSelling').prop('disabled', true);
	$('#submitSelling').click(function(event) {
		$(directSelling).submit(function(){
			var productImage = $('#fileUpload').val();
			var productUpload = $('#productFile').val();
			var downloadLink = $('#download-Link').val();
			if(productImage != ''){
				if(productUpload != '' || downloadLink != ''){
					$('.bs-example-modal-sm').modal('show');
				}else{
				displayError('Please provide the Product item or its download link');
				}
			}
		});	
	});
	//Auction Submit
	$('#SubmitButton').click(function(event) {
		$(fileupload).submit(function(){
		var startDateValue = $('#startDate').val();
		var endDateValue = $('#endDate').val();
		var productImage = $('#fileUpload').val();
		var copyrightFile = $('#copyrightFileUpload').val();
		var productUpload = $('#productFile').val();
		var downloadLink = $('#download-Link').val();
		if(startDateValue != '' && endDateValue != '' && productImage != '' && copyrightFile != ''){
			if(productUpload != '' || downloadLink != ''){
				$('.bs-example-modal-sm').modal('show');
			}else{
				displayError('Please provide the Product item or its download link');
			}
		}else{
		}
		});	
	});

// watchUser ajax
 $('.watchUser').on('click', function(e){ 
      e.preventDefault(); 
      var userid=$(this).val();
        $(this).addClass('hidden');
        $('.unwatchUser').removeClass('hidden');
 	  $.post('/watchUser',{id:userid},function(data){
      });
    });
 //unwatchUser ajax
 $('.unwatchUser').on('click', function(e){ 
      e.preventDefault(); 
      var userid=$(this).val();
      $(this).addClass('hidden');
      $('.watchUser').removeClass('hidden');
 	  $.post('/unwatchUser',{id:userid},function(data){
      });
    });


 $('.unread').hover(function(e) {
 	e.preventDefault(); 
 	var notifid=$(this).children('.notifID').text();
 	$(this).removeClass('unread');
    $(this).children('.readStatus').text('Read');
 	  $.post('/readNotif',{id:notifid},function(data){
 	  	   $('#unreadNotif').text(data);
      });

	});
});//end of onload

