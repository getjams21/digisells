    <!-- Sidebar -->
        <div id="sidebar-wrapper" class="col-md-1 hidden-print" style="padding-left:0;">
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
                        <b>Listings </b>
                    </a>
                    <ul class="sidecontent collapse">
                        <li>
                             <a href="/auctionList"><i>Auctions</i></a>
                        </li>
                        <li>
                             <a href="/directSellingList"><i>Direct Selling</i></a>
                        </li>
                    </ul>
                </li>
                 <li class="sidehead" >
                     <a href="#">
                        <b>Bids</b>
                    </a>
                    <ul class="sidecontent collapse">
                        <li>
                             <a href="/activebids"><i>Active Bids</i></a>
                        </li>
                        <li>
                             <a href="/inactivebids"><i>Inactive Bids</i></a>
                        </li>
                    </ul>
                </li>
                <li class="sidehead">
                    <a href="#">
                        <b>Sales</b>
                    </a>
                    <ul class="sidecontent collapse">
                        <li>
                             <a href="/soldAuctions"><i>Sold Auction Events</i></a>
                        </li>
                        <li>
                             <a href="/soldSelling"><i>Sold D-selling </i></a>
                       </li>
                    </ul>
                </li>
                <li class="sidehead">
                    <a href="#">
                        <b>Funds</b>
                    </a>
                    <ul class="sidecontent collapse">
                        <li>
                             <a href="/payment"><i>Deposits</i></a>
                        </li>
                        <li>
                             <a href="/withdrawal"><i>Withdrawals</i></a>
                       </li>
                    </ul>
                </li>
                <li class="sidehead">
                    <a href="#">
                        <b>Watchlist </b>
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
                    <a href="/affiliations">Affiliations</a>
                </li>
                <li>
                    <a href="/credits">Credits</a>
                </li>
            </ul>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

       
