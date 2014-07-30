<div class="row" >
<nav class="navbar navbar-default navbar-fixed-top nav-bg" role="navigation">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand logo" href="/">
      </a>
      <a class="navbar-brand logo-text" href="/">
      	<font size="6" color="white"><b>DigiSells</b></font>
      </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse navbar-align" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
      	<li><a href="/">Home</a></li>
        <li><a href="#">Sell</a></li>
        <li><a href="#">Affiliate</a></li>
        <li><a href="#">Marketplace</a></li>
      </ul>
      <form class="navbar-form navbar-left" role="submit">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Product Search">
        </div>
        <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
      </form>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">Register</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Login <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
			{{ Form::open() }}
          		<div class="form-group">
          			<li class="form-inline"> 
          				{{ Form::text('Email','',array('class'=>'span3 form-control input-prop','placeholder'=>'Email')) }} 
          			</li>
          			<li class="form-inline">
          				{{ Form::password('Password',array('class'=>'span3 form-control input-prop','placeholder'=>'Password')) }}
          			</li>
          			<li class="form-inline">
          				<center>
							<button type="submit" class="btn btn-success btn-prop">Sign in</button>
          				</center>
          				
          			</li>
          		</div>
          		<!-- <li>Username: &nsbp </li>
	            <li><a href="#">Another action</a></li>
	            <li><a href="#">Something else here</a></li>
	            <li class="divider"></li>
	            <li><a href="#">Separated link</a></li> -->
          	{{ Form::close() }}
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
</div>
