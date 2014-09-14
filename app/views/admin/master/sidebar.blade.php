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
                    <a href="#"><i class="fa fa-list" ></i> Manage Listings<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="#">Auction Events <span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                <li>
                                    <a href="/admin-auctions?status=0" id="Current_Auctions">Current Auctions</a>
                                </li>
                                <li>
                                    <a href="/admin-auctions?status=1" id="Sold_Auctions">Sold Auctions</a>
                                </li>
                                <li>
                                    <a href="/admin-auctions?status=0&expired=1" id="Expired_Auctions">Expired Auctions</a>
                                </li>
                               
                            </ul>
                        </li>
                        <li>
                            <a href="#"> Direct Selling <span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                <li>
                                    <a href="#" id="Active_Selling"> Active Selling</a>
                                </li>
                                <li>
                                    <a href="#" id="Expired_Selling"> Ended Selling</a>
                                </li>
                               
                            </ul>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="#"><i class="fa fa-usd fa-fw"></i> Biddings<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="#" id="Active_Biddings"> Active Biddings<span ></span></a>
                        </li>
                        <li>
                            <a href="#" id="Inactive_Biddings"> Inactive Biddings</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="#"><i class="fa fa-shopping-cart">&nbsp;</i> Sales<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="#" id="Auction_Sales">Auction Sales<span></span></a>
                        </li>
                        <li>
                            <a href="#" id="Direct_Selling">Direct Selling Sales</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="#"><i class="fa fa-money">&nbsp;</i> Funding Activities<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="#"> Fund Deposits<span ></span></a>
                        </li>
                        <li>
                            <a href="#"> Fund Withdrawals</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="#"><i class="fa fa-wrench fa-fw"></i> Settings<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="#">Panels and Wells</a>
                        </li>
                        <li>
                            <a href="#">Buttons</a>
                        </li>
                        <li>
                            <a href="#">Notifications</a>
                        </li>
                        <li>
                            <a href="#">Typography</a>
                        </li>
                        <li>
                            <a href="#">Grid</a>
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