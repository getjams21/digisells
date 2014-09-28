<div class="navbar-default sidebar top-links" role="navigation" style="margin-top:65px;">
        <div class="sidebar-nav navbar-collapse" >
            <ul class="nav" id="side-menu">
                <li class="sidebar-search">
                    <div class="input-group custom-search-form">
                        <input type="text" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                        <button class="btn btn-default" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                    </div>
                    <!-- /input-group -->
                </li>
                <li>
                    <a href="/admin" id="Dashboard"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-user" ></i> User Accounts<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level head">
                        <li>
                            <a  href="/admin-users?status=1" id="Active_Accounts"> Active Accounts</a>
                        </li>
                        <li>
                            <a href="/admin-users?status=0" id="Inactive_Accounts"> Inactive Accounts</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="/admin-categories" id="Manage_Categories"><i class="fa fa-sitemap fa-fw" >&nbsp;</i> Manage Categories</a>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="#"><i class="fa fa-list" ></i> View Listings<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="/admin-auctions?expired=0" id="Auction_List">Auction Events </a>
                        </li>
                        <li>
                            <a href="/admin-selling?expired=0" id="Selling_List"> Direct Selling Events</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="/admin-bidding" id="Active_Biddings"><i class="fa fa-usd fa-fw" ></i> Active Biddings</a>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="#"><i class="fa fa-shopping-cart">&nbsp;</i> Sales<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="/admin-auctionSales" id="Auction_Sales">Auction Sales<span></span></a>
                        </li>
                        <li>
                            <a href="/admin-sellingSales" id="Selling_Sales">Direct Selling Sales</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="#"><i class="fa fa-money">&nbsp;</i> Funding Activities<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="/admin-deposits" id="Fund_Deposits"> Fund Deposits<span ></span></a>
                        </li>
                        <li>
                            <a href="/admin-withdrawals" id="Fund_Withdrawals"> Fund Withdrawals</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="#"><i class="fa fa-wrench fa-fw"></i> Settings<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="#">Settings Churva</a>
                        </li>
                        </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="#"><i class="fa fa-bullhorn fa-fw"></i> Complaints<span class="fa arrow"></span></a>
                </li>
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>