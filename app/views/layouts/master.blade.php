<!doctype html>
<html>
	<head>
		 <link rel="shortcut icon" type="image/x-icon" href="_/fonts/favicon.ico" />
		<meta charset="utf-8">
		{{ HTML::style('_/css/bootstrap.css') }}
		{{ HTML::style('_/css/mystyle.css') }}
	</head>
	<body>
		<font face="Segoe UI">
		@yield('header')
		@yield('carousel')
		@yield('content')
		</font>
		{{ HTML::script('_/js/bootstrap.js') }}
		{{ HTML::script('_/js/myscript.js')}}
	</body>
</html>