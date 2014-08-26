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
                    <a href="/notifications">Notifications</a>
                </li>
                 <li class="sidehead">
                     <a href="#">
                        <b>Bids &nbsp;&nbsp;<span class="caret"></span></b>
                    </a>
                    <ul class="sidecontent collapse">
                        <li>
                             <a href="/wonbids"><i>Won Bids</i></a>
                        </li>
                        <li>
                             <a href="/inactivebids"><i>Inactive Bids</i></a>
                        </li>
                    </ul>
                </li>
                <li class="sidehead">
                    <a href="#">
                        <b>Listings &nbsp;&nbsp;<span class="caret"></span></b>
                    </a>
                    <ul class="sidecontent collapse">
                        <li>
                             <a href="/auctionList"><i>Auction</i></a>
                        </li>
                        <li>
                             <a href="/directSellingList"><i>Direct Selling</i></a>
                        </li>
                    </ul>
                </li>
                <li class="sidehead">
                    <a href="#">
                        <b>Funds &nbsp;&nbsp;<span class="caret"></span></b>
                    </a>
                    <ul class="sidecontent collapse">
                        <li>
                             <a href="/funds"><i>Deposits</i></a>
                        </li>
                        <li>
                             <a href="#"><i>Withdrawals</i></a>
                       </li>
                    </ul>
                </li>
                <li class="sidehead">
                    <a href="#">
                        <b>Watchlist &nbsp;&nbsp;<span class="caret"></span></b>
                    </a>
                    <ul class="sidecontent collapse">
                        <li>
                             <a href="/watchlist"><i>Watching</i></a>
                        </li>
                        <li>
                             <a href="/watchers"><i>Watchers</i></a>
                       </li>
                    </ul>
                </li>
                <li>
                    <a href="/invoices">Invoices</a>
                </li>
                <li>
                    <a href="#">Credits</a>
                </li>
            </ul>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

       
