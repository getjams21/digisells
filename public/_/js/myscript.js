$(document).on("change",".btn-file :file",function(){var e=$(this),t=e.get(0).files?e.get(0).files.length:1,a=e.val().replace(/\\/g,"/").replace(/.*\//,"");e.trigger("fileselect",[t,a])}),$(document).ready(function(){function e(){if(0!=$("#MinimumPrice").val()||""!=$("#MinimumPrice").val()){var e=parseFloat($("#MinimumPrice").val()),t=.05*e,a=e+t;$("#bid-price").text("$"+a.toFixed(2)),$(".validateMinPrice").hide(),$(".customized-bid").hide(),$(".next-bid-info").show()}else $(".next-bid-info").hide(),$(".validateMinPrice").show()}function t(e){if(0!=$("#MinimumPrice").val()||""!=$("#MinimumPrice").val()){var t=parseFloat(e),a=parseFloat($("#MinimumPrice").val()),i=parseFloat(t+a);$("#customBid").text("$"+i.toFixed(2)),$(".validateMinPrice").hide(),$(".next-bid-info").hide(),$(".customized-bid").show()}else $(".customized-bid").hide(),$(".validateMinPrice").show()}function a(){var e=document.getElementById("password"),t=document.getElementById("password_confirmation"),a=document.getElementById("confirmMessage");e.value==t.value?(t.style.backgroundColor=y,a.style.color=y,a.innerHTML="Passwords Match!"):(t.style.backgroundColor=k,a.style.color=M,a.innerHTML="Passwords Does Not Match!")}$(".btn-file :file").on("fileselect",function(e,t,a){var i=$(this).parents(".input-group").find(":text"),n=t>1?t+" files selected":a;i.length?i.val(n):n&&alert(n)});var i=new Date,n=i.getDate(),o=i.getMonth()+1,s=i.getFullYear(),l=i.getHours(),r=i.getMinutes(),c=i.getSeconds();10>n&&(n="0"+n),10>o&&(o="0"+o),i=o+"-"+n+"-"+s;var d=l+":"+r+":"+c;$(".carousel").carousel(),$("#startDate, #grp-startDate").click(function(){$(this).data("date",i),$("#grp-startDate").val(i),$("#startDate").val(i),$(this).datepicker("show")}),$("#endDate, #grp-endDate").click(function(){$(this).val(""),$(this).data("date",i),$("#grp-endDate").val(i),$("#endDate").val(i),$(this).datepicker("show")}),$("#endDate").focus(function(){var e=$(this).val(),t=e+" "+d;$(this).val(t)}),$("#endDate").focusout(function(){var e=$(this).val(),t=e+" "+d;$(this).val(t)}),$("#endDate").change(function(){var e=$(this).val(),t=e+" "+d;$(this).val(t)}),$("#standard").click(function(){$(this).addClass("active"),$("#customized").removeClass("active")}),$("#customized").click(function(){$(this).addClass("active"),$("#standard").removeClass("active")}),$("#standard").hover(function(){$(this).popover("show")},function(){$(this).popover("hide")}),$("#customized").hover(function(){$(this).popover("show")},function(){$(this).popover("hide")}),$("#affiliation").hover(function(){$(this).popover("show")},function(){$(this).popover("hide")}),$("#customized").click(function(){var e=parseFloat($("#bidIncrement").val());t(e)}),$("#standard").click(function(){e()}),$("#MinimumPrice").keyup(function(){if($("#standard").hasClass("active"))e();else{var a=parseFloat($("#bidIncrement").val());t(a)}}),$("#bidIncrement").keyup(function(){var e;e=""==$("#bidIncrement").val()?.01:$("#bidIncrement").val(),t(e)}),$("#bidIncrement").change(function(){if(""==$("#bidIncrement").val()||0==$("#bidIncrement").val()){var e=.01;$("#bidIncrement").val(e),e=$("#bidIncrement").val()}else e=$("#bidIncrement").val();t(e)}),$("#affiliation").click(function(){$(".validateAffOption").hide(),$(".affiliation").show(),$(this).hide()}),$("#disableAffiliation").click(function(){$(".validateAffOption").show(),$(".affiliation").hide(),$("#affiliation").show()}),$("#SubmitButton").prop("disabled",!0),$("#fileName").attr("disabled",!0),$("#fileUpload").click(function(){$("#fileName").attr("disabled",!1),$("#fileName").focus()}),$("#fileName").blur(function(){var e=$(this).val();switch(e.substring(e.lastIndexOf(".")+1).toLowerCase()){case"gif":case"jpg":case"png":case"bmp":$("#SubmitButton").prop("disabled",!1),$(".validateImage").hide();break;default:$(".validateImage").show()}}),$("#SubmitButton").click(function(){$("#showUploadModal").trigger("click")}),$("#showModal").click(function(){$("#myModal").modal("show")});var u=$("#progressbar"),m=$("#statustxt"),f=$("#SubmitButton"),v=$("#fileupload"),h=$(".saving"),p=$(".saved"),g="0%";$(v).ajaxForm({beforeSend:function(){f.attr("disabled",""),m.empty(),u.css({width:g}),m.css("color","#000")},uploadProgress:function(e,t,a,i){u.css({width:i+"%"}),m.css({html:i+"%"}),i>50&&m.css("color","#fff")},complete:function(){m.css({html:"100%"}),h.css({display:"none"}),p.css({display:"block"}),f.removeAttr("disabled")}});var b=document.title;document.getElementsByTagName("body")[0].id=b,"Login"==b?($(".nav-dropdown").hide(),$("#Login a:contains('Login')").parent().addClass("active")):$("ul.nav li.dropdown").hover(function(){$(".dropdown-menu",this).fadeIn()},function(){$(".dropdown-menu",this).fadeOut("fast")}),$("#Register a:contains('Register')").parent().addClass("active"),$("#Home a:contains('Home')").parent().addClass("active");var y="#66cc66",k="#FFE6BB",w="#C3FDB8",M="red";$("#password_confirmation").keyup(function(){a()}),$("#password").keyup(function(){a()}),$("#username").on("blur",function(e){e.preventDefault();var t=$("#username").val();$.post("searchUser",{username:t},function(e){var a=document.getElementById("username"),i=document.getElementById("searchMessage"),n=t.length;0==e?2>=n?(a.style.backgroundColor=k,i.style.color=M,i.innerHTML="Must consist 3 or more characters!"):(a.style.backgroundColor=w,i.style.color=y,i.innerHTML="Username Available"):1==e&&(a.style.backgroundColor=k,i.style.color=M,i.innerHTML="Username Taken!")})}),$("#email").on("blur",function(e){e.preventDefault();var t=/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/,a=document.getElementById("email"),i=document.getElementById("searchEmail"),n=$("#email").val();return t.test(a.value)?($.post("searchEmail",{email:n},function(e){0==e?(a.style.backgroundColor=w,i.style.color=y,i.innerHTML="Email Available"):(a.style.backgroundColor=k,i.style.color=M,i.innerHTML="Email Taken!")}),void 0):(a.style.backgroundColor=k,i.style.color=M,i.innerHTML="Invalid Email Address!",n.focus,!1)}),$("#email").change(function(){return filter.test(emailbox.value)?void 0:(emailbox.style.backgroundColor=k,message.style.color=M,message.innerHTML="Invalid Email Address!",email.focus,!1)})});