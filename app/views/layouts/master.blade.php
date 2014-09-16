<!doctype html>
<html>
	<head>  
		 <link rel="shortcut icon" type="image/x-icon" href="_/fonts/favicon.ico" />
		<meta charset="utf-8">
		{{ HTML::style('_/css/bootstrap.css') }}
		{{ HTML::style('_/css/plugins/dataTables.bootstrap.css') }}
<<<<<<< HEAD
=======
		{{ HTML::style('_/css/mystyle.css') }}
		{{ HTML::style('_/css/datepicker.css') }}
		{{ HTML::style('_/css/simple-sidebar.css') }}
>>>>>>> 81aa945b7d49d675fecb437b6a87065dadb98535
		{{ HTML::style('_/font-awesome-4.1.0/css/font-awesome.min.css') }}
		{{ HTML::style('_/css/datepicker.css') }}
		{{ HTML::style('_/css/simple-sidebar.css') }}
		{{ HTML::style('_/css/mystyle.css') }}
		{{ HTML::style('_/css/sb-admin-2.css') }}
		@yield('styles') 
		<title>@yield('meta-title', 'Digisells')</title>
		<noscript>
		 For full functionality of this site it is necessary to enable JavaScript.
		 Here are the <a href="http://www.enable-javascript.com/" target="_blank">
		 instructions how to enable JavaScript in your web browser</a>.
		</noscript>
	</head>
	<body>
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
<<<<<<< HEAD
		@yield('script')
=======
		{{ HTML::script('_/js/plugins/dataTables/jquery.dataTables.js') }}
		{{ HTML::script('_/js/plugins/dataTables/dataTables.bootstrap.js') }}
		{{ HTML::script('_/js/sb-admin-2.js') }}
		@yield('scripts')
>>>>>>> 81aa945b7d49d675fecb437b6a87065dadb98535
		{{ HTML::script('_/js/myscript.js')}}
		{{ HTML::script('_/js/printThis.js') }}
	</body>
</html>