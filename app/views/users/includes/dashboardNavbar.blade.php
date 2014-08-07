    <!-- Sidebar -->

        <div id="sidebar-wrapper" class="col-md-1" style="padding-left:0;">
            <div id="showSidebar sidebar">
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
                    <a href="#">Invoices</a>
                </li>
                 <li class="sidehead">
                     <a ><i ></i> Buying<span class=""></span></a>
                    <ul class="sidecontent collapse">
                        <li>
                             <a href="">Bids</a>
                        </li>
                        <li>
                             <a href="">Offers</a>
                       </li>
                    </ul>
                </li>
                <li class="sidehead">
                    <a href="#">Selling</a>
                    <ul class="sidecontent collapse">
                        <li>
                             <a href="">Selling</a>
                        </li>
                        <li>
                             <a href="">Offers</a>
                       </li>
                    </ul>
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

       
