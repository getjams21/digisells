<!doctype html>
<html>
	<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# digisells: http://ogp.me/ns/fb/digisells#">  
		 <link rel="shortcut icon" type="image/x-icon" href="_/fonts/favicon.ico" />
		<meta charset="utf-8">
		<meta property="fb:app_id" content="1497689920490189">
		<meta property="fb:admins" content="10202842632170362"/>
	  	<!-- <meta property="og:type"   content="digisells:home" /> 
	 	<meta property="og:url"    content="http://digisells.com/" /> 
	 	<meta property="og:title"  content="Sample Home" /> 
	 	<meta property="og:image"  content="https://fbstatic-a.akamaihd.net/images/devsite/attachment_blank.png" />  -->
		@yield('metatags')
		{{ HTML::style('_/css/bootstrap.css') }}
		{{ HTML::style('_/css/plugins/dataTables.bootstrap.css') }}
		{{ HTML::style('_/css/mystyle.css') }}
		{{ HTML::style('_/css/datepicker.css') }}
		{{ HTML::style('_/css/simple-sidebar.css') }}
		{{ HTML::style('_/font-awesome-4.1.0/css/font-awesome.min.css') }}
		{{ HTML::style('_/css/datepicker.css') }}
		{{ HTML::style('_/css/simple-sidebar.css') }}
		{{ HTML::style('_/css/mystyle.css') }}
		{{ HTML::style('_/css/sb-admin-2.css') }}
		{{ HTML::style('_/css/plugins/social-buttons.css') }}
		@yield('styles') 
		<title>@yield('meta-title', 'Digisells')</title>
		<noscript>
		 For full functionality of this site it is necessary to enable JavaScript.
		 Here are the <a href="http://www.enable-javascript.com/" target="_blank">
		 instructions how to enable JavaScript in your web browser</a>.
		</noscript>
	</head>
	<body>
	  <script>
      window.fbAsyncInit = function() {
        FB.init({
          appId      : '1497689920490189',
          xfbml      : true,
          version    : 'v2.0'
        });
      };
      (function(d, s, id){
         var js, fjs = d.getElementsByTagName(s)[0];
         if (d.getElementById(id)) {return;}
         js = d.createElement(s); js.id = id;
         js.src = "//connect.facebook.net/en_US/sdk.js";
         fjs.parentNode.insertBefore(js, fjs);
       }(document, 'script', 'facebook-jssdk'));
    </script>
		@yield('inbodyscripts')
		<div id="fblike">
			<div
			  class="fb-like"
			  data-share="true"
			  data-width="450"
			  data-show-faces="true">
			</div>
		</div>
		<font face="Segoe UI">
		@yield('header')
		@yield('carousel')
		@yield('featured') 
		@yield('content')
		@yield('footer')
		</font>
		{{ HTML::script('_/js/bootstrap.js') }}
		{{ HTML::script('_/js/plugins/dataTables/jquery.dataTables.js') }}
		{{ HTML::script('_/js/plugins/dataTables/dataTables.bootstrap.js') }}
		{{ HTML::script('_/js/bootstrap-datepicker.js') }}
		{{ HTML::script('_/js/jquery.form.js') }}
		{{ HTML::script('_/js/plugins/metisMenu/metisMenu.min.js') }}
		@yield('script')
		{{ HTML::script('_/js/plugins/dataTables/jquery.dataTables.js') }}
		{{ HTML::script('_/js/plugins/dataTables/dataTables.bootstrap.js') }}
		{{ HTML::script('_/js/sb-admin-2.js') }}
		@yield('scripts')
		{{ HTML::script('_/js/myscript.js')}}
		{{ HTML::script('_/js/printThis.js') }}
	</body>
</html>