    <!-- Sidebar -->
        <div id="sidebar-wrapper" class="col-md-1" style="padding-left:0;">
            <div id="showSidebar sidebar">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="/users/{{Auth::user()->username}}" class="active">
                        @if(Auth::user()->firstName)
                            {{Auth::user()->firstName." ".Auth::user()->lastName}}
                        @else
                            {{Auth::user()->username}}
                        @endif
                    </a>
                </li>
                <li>
                    <a href="/users/{{Auth::user()->username}}/edit" >Update Profile</a>
                </li>
                <li>
                    <a href="/users/{{Auth::user()->username}}/invoices">Invoices</a>
                </li>
                 <li class="sidehead">
                     <a href="#"><b>Buying &nbsp;&nbsp;<span class="caret"></span></b></a>
                    <ul class="sidecontent collapse">
                        <li>
                             <a href="/users/{{Auth::user()->username}}/bids"><i>Bids</i></a>
                        </li>
                        <li>
                             <a href=""><i>Offers</i></a>
                       </li>
                    </ul>
                </li>
                <li class="sidehead">
                    <a href="#"><b>Selling &nbsp;&nbsp;<span class="caret"></span></b></a>
                    <ul class="sidecontent collapse">
                        <li>
                             <a href=""><i>Selling</i></a>
                        </li>
                        <li>
                             <a href=""><i>Offers</i></a>
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

       
