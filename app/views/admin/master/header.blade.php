<!-- Navigation -->
        <nav class="navbar navbar-default navbar-fixed-top nav-bg" role="navigation" style="margin-bottom: 0"> 
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
              &nbsp;<a class="navbar-brand logo" href="/" style="margin-left:15px;"></a>
              <a class="navbar-brand logo-text" href="/">
                <font size="5" color="white"><b>Admin</b></font>
              </a>
            </div>
            <!-- /.navbar-header -->

            <ul class="collapse navbar-collapse nav navbar-top-links navbar-right top-links">
                
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-comment fa-fw"></i> New Comment
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                    <span class="pull-right text-muted small">12 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> Message Sent
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-tasks fa-fw"></i> New Task
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>See All Alerts</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-alerts -->
                </li>
                <!-- /.dropdown -->
  <li class="dropdown" >
    
    <a  class="dropdown-toggle" style="height:48px;" data-toggle="dropdown" href="#" >
       @if(Auth::user()->userImage){{ HTML::image('images/users/'.Auth::user()->username."/".Auth::user()->userImage, 'profile photo', array('class' => 'nav-img')) }}
    @else
    {{ HTML::image('images/users/default.png', 'profile photo', array('class' => 'nav-img')) }}
    @endif
        @if(Auth::user()->type)
          {{Auth::user()->firstName}}
        @else
          {{Auth::user()->username}}
        @endif
      <span class="badge alert-danger" id="unreadNotif">{{Config::get('currentNotifications')}}</span>
      <span class="caret" ></span></a>
      
      <ul class="dropdown-menu logout-link" role="menu" >
        <li>
        <a href="/">
         <i class="fa fa-share"></i> Go to Main
        </a>
      </li>
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
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->