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
        <li class="dropdown" >
          <a href="" class="dropdown-toggle" style="height:50px;">
            Marketplace
            <span class="caret" ></span></a>
            
            <ul class="dropdown-menu logout-link" role="menu" style="width: 127px;">

            <li>
              <a href="/auction-listings">
                Auctions
              </a>
            </li>
            <li>
              <a href="/direct-selling-listings" >
                Listings
              </a>
            </li>
        </ul>

       </li>
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
    <a href="/payment"> <b>FUNDS: 
     <span class="glyphicon glyphicon-usd"></span>
       {{ Auth::user()->fund}}
      </b>
    </a>
  </li>
  <li class="dropdown" >
    
    <a href="/notifications" class="dropdown-toggle" style="height:50px;">
       @if(Auth::user()->userImage){{ HTML::image('images/users/'.Auth::user()->username."/".Auth::user()->userImage, 'profile photo', array('class' => 'nav-img')) }}
    @else
    {{ HTML::image('images/users/default.png', 'profile photo', array('class' => 'nav-img')) }}
    @endif
      {{Auth::user()->username}}
      <span class="badge alert-danger" id="unreadNotif">{{Config::get('currentNotifications')}}</span>
      <span class="caret" ></span></a>
      
      <ul class="dropdown-menu logout-link" role="menu" >

      <li>
        <a href="/selling">
         <span class="glyphicon glyphicon-pencil"></span> Create Listing
        </a>
      </li>
      <li>
        <a href="/notifications" >
          <span class="glyphicon glyphicon-bell"></span> Notifications
        </a>
      </li>
      <li>
        <a href="/users/{{Auth::user()->username}}" >
          <span class="glyphicon glyphicon-user"></span> Profile
        </a>
      </li>
      <li  class="divider"></li>
      <li>
        <a href="/logout" ><span class="glyphicon glyphicon-log-out"></span> Logout</a>
      </li>
  </ul>

  </li>
@endif
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
</div>
