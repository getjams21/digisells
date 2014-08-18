<div class="wrapper" >
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
      <ul class="nav navbar-nav" id="nav">
      	<li><a href="/">Home</a></li>
        <li><a href="/selling">Sell</a></li>
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
@if (Auth::guest())
        <li><a href="/register">Register</a></li>
        <li class="dropdown">
          <a href="/login" class="dropdown-toggle" >Login <span class="caret"></span></a>
          <ul class="dropdown-menu nav-dropdown square" role="menu">
			{{ Form::open(['route'=>'sessions.store']) }}
          		<div class="form-group">
          			<li class="form-inline"> 
          				{{ Form::text('username','',array('class'=>'span3 form-control input-prop square','placeholder'=>'username','required'=>'required')) }} 
          			</li>
          			<li class="form-inline">
          				{{ Form::password('password',array('class'=>'span3 form-control input-prop square','placeholder'=>'Password','required'=>'required')) }}
          			</li>
          			<li class="form-inline">
          				<center>
							<button type="submit" class="btn btn-primary btn-prop" style="margin-left:50%;">Sign in</button>
          				</center>
          				
          			</li>
          		</div>
          	{{ Form::close() }}
          </ul>
        </li>
@else
  <li>
    @if(Auth::user()->userImage)
    <a href="/users/{{Auth::user()->username}}" style="padding:0;">{{ HTML::image('images/users/'.Auth::user()->username."/".Auth::user()->userImage, 'profile photo', array('class' => 'nav-img')) }}</a>
    @else
    <a href="/users/{{Auth::user()->username}}" style="padding:0;">
    {{ HTML::image('images/users/default.png', 'profile photo', array('class' => 'nav-img')) }}</a>
    @endif
  </li>
  <li ><a href="/dashboard">{{Auth::user()->username}} &nbsp;
      <span class="badge alert-info" style="text-indent:0;">
         $
        @if(Config::get('currentfund'))
        {{Config::get('currentfund')}}
        @else
        0 USD
        @endif
      </span></a>
  </li>
  <li><a href="/logout">Sign out</a></li>
@endif
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
</div>
