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

    //Error properties
    function displayError(errorMsg){
    	$('#error-msg').text(errorMsg);
			$( ".error-panel" ).animate({
			    width: "100%",
			    opacity: 1,
			  }, 300 );
    }
    function hideError(){
    	$( ".error-panel" ).animate({
			    width: "0%",
			    opacity: 0,
			  }, 300 );
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

	//validate auction starting date
	// $('#startDate').prop('disabled', true);
	$('#startDate').change(function(event) {
		if ($(this).val()<today) {
			var errorMsg = 'Invalid Date! Starting Date must not be a PAST date.';
			displayError(errorMsg);
			$('#SubmitButton').prop('disabled', true);
		}else{
			hideError();
			$('#SubmitButton').prop('disabled', false);
		};
	});
	//validate auction end date
	$('#endDate').change(function(event) {
		if ($(this).val()<=today) {
			var errorMsg = 'Invalid Date! End Date must not be a PAST or CURRENT date.';
			displayError(errorMsg);
			$('#SubmitButton').prop('disabled', true);
		}else{
			hideError();
			$('#SubmitButton').prop('disabled', false);
		};
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
		if ($('#MinimumPrice').val() != '') {
			var minPrice = parseFloat($('#MinimumPrice').val());
			if (minPrice == 0){
				displayError('Minimum Price must NOT be 0');
			}else{
				var incrementPercentage = minPrice * 0.05;
				var firstBidPrice = minPrice + incrementPercentage;
				//alert('$ '+firstBidPrice.toFixed(2));
				$('#bid-price').text('$'+firstBidPrice.toFixed(2));
				// $('.validateMinPrice').hide();
				hideError();
				$('.customized-bid').hide();
				$('.next-bid-info').show();
			}
		
		}else{
			$('.next-bid-info').hide();
			displayError('Minimum Price must NOT be EMPTY!');
			// $('.validateMinPrice').show();
		}
	}
	function calculateCustomizedIncrementation(incVal){
		if ($('#MinimumPrice').val() != '') {
			var incValue = parseFloat(incVal);
			var minPrice = parseFloat($('#MinimumPrice').val());
			if(minPrice == 0){
				displayError('Minimum Price must NOT be 0');
			}else{
				var firstBidPrice = parseFloat(incValue + minPrice);
				$('#customBid').text('$'+firstBidPrice.toFixed(2));
				hideError();
				$('.next-bid-info').hide();
				$('.customized-bid').show();
			}
		}else {
			$('.customized-bid').hide();
			displayError('Minimum Price must NOT be EMPTY!');
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

	//validate Image file
	//$('#fileName').attr('disabled', true);
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
    		$('.validateImageSize').hide();
    		switch(filename.substring(filename.lastIndexOf('.')+1).toLowerCase()){
			case 'gif': case 'jpg': case 'png': case 'bmp':
				$('#SubmitButton').prop('disabled', false);
				$('.validateImage').hide();
				break;
			default:
				$('#SubmitButton').prop('disabled', true);
				$('.validateImage').show();
			}
    	}else{
    		$('.validateImageSize').show();
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
				$('.validateCopyrightFile').hide();
				break;
			default:
				$('#SubmitButton').prop('disabled', true);
				$('.validateCopyrightFile').show();
		}
	});
	$('#downloadLink').hover(function() {
		$(this).popover('show');
	}, function() {
		$(this).popover('hide');
	});
	//Disable Submit Button
	$('#SubmitButton').prop('disabled', true);

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
	$("#Register a:contains('Register')").parent().addClass('active');
	$("#Home a:contains('Home')").parent().addClass('active');
	$("#Dashboard a:contains('Dashboard')").parent().addClass('active');

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
		    if((pass.length >= 4) && (pass.length <= 15))
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
			        message.innerHTML = "Passwords Must be 4 to 15 characters only!"
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
//SIDEBAR toggle js
//temporary disabled 
	 // $("#page-content-wrapper").hover(function(e) {
	 //        e.preventDefault();
	 //        $("#wrapper").toggleClass("toggled");
	 //    });
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

//SIDEBAR HOVER COLLAPSE
	$('.sidehead').hover(function() {
			$(this).children('ul').removeClass('collapse');
		}, function() {
			$(this).children('ul').addClass('collapse');
		});

//submit validation. Don't eput codes next to it. this must
//be the last codes.

	$(fileupload).submit(function(event){
		$('.bs-example-modal-sm').modal('show');
	});	
});//end of onload

