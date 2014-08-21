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
                    <a href="/invoices">Invoices</a>
                </li>
                 <li class="sidehead">
                     <a href="#">
                        <b>Buying &nbsp;&nbsp;<span class="caret"></span></b>
                    </a>
                    <ul class="sidecontent collapse">
                        <li>
                             <a href="/bids"><i>Bids</i></a>
                        </li>
                        <li>
                             <a href="/watchlist"><i>Watchlist</i></a>
                        </li>
                    </ul>
                </li>
                <li class="sidehead">
                    <a href="#">
                        <b>Selling &nbsp;&nbsp;<span class="caret"></span></b>
                    </a>
                    <ul class="sidecontent collapse">
                        <li>
                             <a href="/listings"><i>My Listings</i></a>
                        </li>
                        <li>
                             <a href="/selling"><i>Create Listing</i></a>
                       </li>
                    </ul>
                </li>
                <li>
                    <a href="/funds">Funds</a>
                </li>
                <li>
                    <a href="#">Credits</a>
                </li>
            </ul>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

       
