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

//change body tag with its meta-title
	var a = document.title;
	document.getElementsByTagName("body")[0].id = a;
	if(a == 'Login'){
		$('.nav-dropdown').hide();	
		$("#Login a:contains('Login')").parent().addClass('active');
	}
	else{
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


	//password verification
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
	//pass validation function
	function passwordValidation(){
		  var pass1 = document.getElementById('password');
		    var pass2 = document.getElementById('password_confirmation');
		    var message = document.getElementById('confirmMessage');
		 	if(pass1.value == pass2.value){
		        pass2.style.backgroundColor = goodColor;
		        message.style.color = goodColor;
		        message.innerHTML = "Passwords Match!"
		    }else{
		        pass2.style.backgroundColor = badColor;
		        message.style.color = badText;
		        message.innerHTML = "Passwords Does Not Match!"
		    }
	}

	//usename verfication
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
    }); 
//email verification
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
    }); 

      $('#email').change(function(){

	    if (!filter.test(emailbox.value)) {
	    	emailbox.style.backgroundColor = badColor;
		    message.style.color = badText;
		    message.innerHTML = "Invalid Email Address!"
	    email.focus;
	    return false;
	    	}
      });

});//end of onload
