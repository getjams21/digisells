$(document).ready(function(){function e(){var e=document.getElementById("password"),a=document.getElementById("password_confirmation"),t=document.getElementById("confirmMessage");e.value==a.value?(a.style.backgroundColor=d,t.style.color=d,t.innerHTML="Passwords Match!"):(a.style.backgroundColor=u,t.style.color=v,t.innerHTML="Passwords Does Not Match!")}var a=new Date,t=a.getDate(),n=a.getMonth()+1,o=a.getFullYear(),i=a.getHours(),s=a.getMinutes(),r=a.getSeconds();10>t&&(t="0"+t),10>n&&(n="0"+n),a=n+"-"+t+"-"+o;var l=i+":"+s+":"+r;$(".carousel").carousel(),$("#startDate, #grp-startDate").click(function(){$(this).data("date",a),$("#grp-startDate").val(a),$("#startDate").val(a),$(this).datepicker("show")}),$("#endDate, #grp-endDate").click(function(){$(this).val(""),$(this).data("date",a),$("#grp-endDate").val(a),$("#endDate").val(a),$(this).datepicker("show")}),$("#endDate").focus(function(){var e=$(this).val(),a=e+" "+l;$(this).val(a)}),$("#endDate").focusout(function(){var e=$(this).val(),a=e+" "+l;$(this).val(a)}),$("#endDate").change(function(){var e=$(this).val(),a=e+" "+l;$(this).val(a)}),$("#standard").click(function(){$(this).addClass("active"),$("#customized").removeClass("active")}),$("#customized").click(function(){$(this).addClass("active"),$("#standard").removeClass("active")}),$("#standard").hover(function(){$(this).popover("show")},function(){$(this).popover("hide")}),$("#standard").click(function(){if(0!=$("#MinimumPrice").val()||""!=$("#MinimumPrice").val()){var e=parseFloat($("#MinimumPrice").val()),a=.05*e,t=e+a;$("#bid-price").text("$"+t.toFixed(2)),$(".validateMinPrice").hide(),$(".next-bid-info").show()}else $(".next-bid-info").hide(),$(".validateMinPrice").show()});var c=document.title;document.getElementsByTagName("body")[0].id=c,"Login"==c?($(".nav-dropdown").hide(),$("#Login a:contains('Login')").parent().addClass("active")):$("ul.nav li.dropdown").hover(function(){$(".dropdown-menu",this).fadeIn()},function(){$(".dropdown-menu",this).fadeOut("fast")}),$("#Register a:contains('Register')").parent().addClass("active"),$("#Home a:contains('Home')").parent().addClass("active");var d="#66cc66",u="#FFE6BB",m="#C3FDB8",v="red";$("#password_confirmation").keyup(function(){e()}),$("#password").keyup(function(){e()}),$("#username").on("blur",function(e){e.preventDefault();var a=$("#username").val();$.post("searchUser",{username:a},function(e){var t=document.getElementById("username"),n=document.getElementById("searchMessage"),o=a.length;0==e?2>=o?(t.style.backgroundColor=u,n.style.color=v,n.innerHTML="Must consist 3 or more characters!"):(t.style.backgroundColor=m,n.style.color=d,n.innerHTML="Username Available"):1==e&&(t.style.backgroundColor=u,n.style.color=v,n.innerHTML="Username Taken!")})}),$("#email").on("blur",function(e){e.preventDefault();var a=/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/,t=document.getElementById("email"),n=document.getElementById("searchEmail"),o=$("#email").val();return a.test(t.value)?($.post("searchEmail",{email:o},function(e){0==e?(t.style.backgroundColor=m,n.style.color=d,n.innerHTML="Email Available"):(t.style.backgroundColor=u,n.style.color=v,n.innerHTML="Email Taken!")}),void 0):(t.style.backgroundColor=u,n.style.color=v,n.innerHTML="Invalid Email Address!",o.focus,!1)}),$("#email").change(function(){return filter.test(emailbox.value)?void 0:(emailbox.style.backgroundColor=u,message.style.color=v,message.innerHTML="Invalid Email Address!",email.focus,!1)})});