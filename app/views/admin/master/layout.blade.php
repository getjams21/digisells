<!doctype html>
<html>
	<head>
		 <link rel="shortcut icon" type="image/x-icon" href="_/fonts/favicon.ico" />
		<meta charset="utf-8">
		<meta name="_token" content="{{ csrf_token() }}" />
		{{ HTML::style('_/css/bootstrap.css') }}
		{{ HTML::style('_/css/plugins/metisMenu/metisMenu.min.css') }}
		{{ HTML::style('_/css/plugins/dataTables.bootstrap.css') }}
		{{ HTML::style('_/css/sb-admin-2.css') }}
		{{ HTML::style('_/font-awesome-4.1.0/css/font-awesome.min.css') }}
		{{ HTML::style('_/css/mystyle.css') }}
		<!-- timeline -->
		{{ HTML::style('_/css/plugins/timeline.css') }}
		@yield('styles')
		<title>@yield('meta-title', 'Admin')</title>
		<noscript>
		 For full functionality of this site it is necessary to enable JavaScript.
		 Here are the <a href="http://www.enable-javascript.com/" target="_blank">
		 instructions how to enable JavaScript in your web browser</a>.
		</noscript>
	</head>
	<body style="padding-top:0;">
		<font face="Segoe UI">
		<div id="wrapper">
			@include('admin.master.header')
			@include('admin.master.sidebar')
		    <div id="page-wrapper" style="margin-top:60px;">
			@yield('content')
			@yield('footer')
			</div>
		</div>
			</font>
			{{ HTML::script('_/js/bootstrap.js') }}
			{{ HTML::script('_/js/jquery.form.js') }}
			<!-- data tables -->
			{{ HTML::script('_/js/plugins/dataTables/jquery.dataTables.js') }}
			{{ HTML::script('_/js/plugins/dataTables/dataTables.bootstrap.js') }}
			{{ HTML::script('_/js/plugins/metisMenu/metisMenu.min.js') }}
			{{ HTML::script('_/js/sb-admin-2.js') }}
			<!-- chart script --><!-- 
			{{ HTML::script('_/js/plugins/morris/raphael.min.js') }}
			{{ HTML::script('_/js/plugins/morris/morris.min.js') }}
			{{ HTML::script('_/js/plugins/morris/morris-data.js') }} -->
			@yield('script')
			{{ HTML::script('_/js/myscript.js')}}
			{{ HTML::script('_/js/printThis.js') }}
			{{ HTML::script('_/js/bootstrap-datepicker.js') }}
	</body>
</html>