<!doctype html>
<html>
	<head>
		 <link rel="shortcut icon" type="image/x-icon" href="_/fonts/favicon.ico" />
		<meta charset="utf-8">
		<title>@yield('meta-title', 'Digisells')</title>
		{{ HTML::style('_/css/bootstrap.css') }}
		{{ HTML::style('_/css/mystyle.css') }}
		<style type="text/css">
		html, body { 
		background-repeat: no-repeat;
		overflow:auto;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;  
	    position: fixed;
	    width:100%;
	    height: 100%;
	    overflow-y: auto;
	    color: #848482;
	    font-family:arial;
		}
		.menu-well{
			background: rgba(61, 62, 60, 0.7);
			margin-top: 130px;
			padding-bottom: 35px;
			margin-left:50px;
			margin-right:80px;
			position: fixed;
	    	border-radius:8px;
		}
		</style>
	</head>
	<body  background='../images/endpage.jpg'>
	<div class="row">
		
		<div class="col-md-5 menu-well"><br>
			<div>
				<h1 align="center"><b> Destination Not Found</b></h1>
				<!-- <br><h3 class="pull-right" style="margin-right:80px;"><small>go HOME</small></h3> -->
			</div>
		</div>
		<div class="col-md-7"></div>
	</div>
	</body>

</html>
