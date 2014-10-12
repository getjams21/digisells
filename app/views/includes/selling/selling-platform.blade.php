
<br>
<div class="container">
    <?php  
        if(!$hasPaypal){
            echo '
                <div class="col-md-12">
                    <div class="alert alert-danger" role="alert">
                        <center>The system detected that you have not yet added your paypal email. You are not be able to list an item. Please do so.
                            <br>
                            <a href="http://digisells.com/users/'.Auth::user()->username.'/edit"><button class="btn btn-primary">Add Paypal</button></a>
                        </center>
                    </div>
                </div>
            ';
        }
    ?>
	<div class="col-md-12">
		<center><h2>What Selling Platform do you want?</h2></center>
		<hr class="style-shadowed">
	</div>
	<div class="col-md-12">
		<div class="col-md-6">
			<center>
                <div class="panel panel-default square well-hide selling-prop">
                    <div class="breadcrumb brd-prop-blue square">
                    	<h3>Auction</h3>
                    </div>
                    <div class="panel-body">
                    	<p>If you think your product is worth the bidders, choose this auction selling option. With this platform you can leverage your profit if you think your product has high demands. You can choose whether to customize the bidding increment or choose the default increment for your auction event. You can also enable product affiliation program so your product will be more exposed. Do you have something to auction?</p>
                    	<a href="/auction" class="btn btn-primary square" 
                            <?php  
                                if(!$hasPaypal){
                                    echo 'disabled';
                                }
                            ?>
                            >I have a product for Auction</a>
                    </div>
                </div>
            </center>
		</div>
		<div class="col-md-6">
			<center>
                <div class="panel panel-default square well-hide selling-prop">
                    <div class="breadcrumb brd-prop-blue square">
                    	<h3>Direct Selling</h3>
                    </div>
                    <div class="panel-body">
                    	<p>With direct selling you don't have to wait for couple of days to acquire your profit. List your product directly and see sales pouring from time to time. You can list up to 10 items for FREE! Yes, it's no kidding, you read it right it's free! You can also enable product affiliation program so your product will be more exposed. More exporsure, means more chances of getting sales. Do you have something to sell?</p>
                    	<a href="/direct-selling" class="btn btn-primary square"
                        <?php  
                            if(!$hasPaypal){
                                echo 'disabled';
                            }
                        ?>
                        >I have something to Sell directly</a>
                    </div>
                </div>
            </center>
		</div>
	</div>
</div>