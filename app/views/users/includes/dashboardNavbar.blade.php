    <!-- Sidebar -->

        <div id="sidebar-wrapper" class="col-md-1" style="padding-left:0;">
            <div id="showSidebar">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="#">
                        @if($user->firstName)
                            {{$user->firstName." ".$user->lastName}}
                        @else
                            {{$user->username}}
                        @endif
                    </a>
                </li>
                <li>
                    <a href="#" class="active">Profile</a>
                </li>
                <li>
                    <a href="#">Shortcuts</a>
                </li>
                <li>
                    <a href="#">Overview</a>
                </li>
                <li>
                    <a href="#">Events</a>
                </li>
                <li>
                    <a href="#">About</a>
                </li>
                <li>
                    <a href="#">Services</a>
                </li>
                <li>
                    <a href="#">Contact</a>
                </li>
            </ul>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

       
