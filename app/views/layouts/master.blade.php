<!doctype html>
<html>
	<head>
		 <link rel="shortcut icon" type="image/x-icon" href="_/fonts/favicon.ico" />
		<meta charset="utf-8">
		{{ HTML::style('_/css/bootstrap.css') }}
		{{ HTML::style('_/css/mystyle.css') }}
		{{ HTML::style('_/css/datepicker.css') }}
		{{ HTML::style('_/css/simple-sidebar.css') }}
		@yield('styles')
		<title>@yield('meta-title', 'Digisells')</title>
		<noscript>
		 For full functionality of this site it is necessary to enable JavaScript.
		 Here are the <a href="http://www.enable-javascript.com/" target="_blank">
		 instructions how to enable JavaScript in your web browser</a>.
		</noscript>
	</head>
	<body >
		<font face="Segoe UI">
		@yield('header')
		@yield('carousel')
		@yield('featured')
		@yield('content')
		@yield('footer')
		</font>
		{{ HTML::script('_/js/bootstrap.js') }}
		{{ HTML::script('_/js/bootstrap-datepicker.js') }}
		{{ HTML::script('_/js/jquery.form.js') }}
		@yield('scripts')
		{{ HTML::script('_/js/myscript.js')}}
	</body>
</html>