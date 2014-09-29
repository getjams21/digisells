<div class="container-fluid">
	<div class="col-md-8 col-md-offset-2">
		<br>
		<br>
		<div class="panel panel-primary">
		  <div class="panel-heading">
		  	<h2 class="panel-title">Auction Result for: <b>{{$auctionResult[0]->auctionName}}</b></h2>
		  </div>
		  <div class="panel-body">
		  <div class="container-fluid">
		  	<div class="col-md-5">
		  		<div class="breadcrumb brd-prop-blue square"><h4>Bidding Details</h4></div>
		  		<div class="table-responsive">
	              <table class="table table-striped table-hover" id="tbl-auction-result">
	                  <thead>
	                    <tr>
	                      <th>Bidders</th>
	                      <th>Bid Amount</th>
	                    </tr>
	                  </thead>
	                  <tbody>
	                    @if ($auctionResult[0])
	                      @foreach ($auctionResult as $result)
	                      <tr>
	                          <td>{{$result->username}}</td>
	                          <td>${{round($result->amount, 2)}}</td>
	                      @endforeach
	                      </tr>
	                    @endif
	                  </tbody>
	              </table>
	            </div>
		  	</div>
		  	<div class="col-md-7">
		  		<div class="breadcrumb brd-prop-blue square"><h4>Auction Summary</h4></div>
		  		<div class="table-responsive">
	              <table class="table table-striped table-hover" id="tbl-auction-result">
	                  <tbody>
	                      <tr>
		                      <td><b>Auction Winner:</b></td>
		                      <td><a href="http://digisells.com/users/{{$summary[0]->username}}">{{$summary[0]->username}}</a></td>
	                      </tr>
	                      <tr>
		                      <td><b>Winner's Bid:</b></td>
		                      <td>${{round($summary[0]->maxAmount, 2)}}</td>
	                      </tr>
	                      <tr>
		                      <td><b>No. of Bidders:</b></td>
		                      <td>{{$bidders[0]->bidders}}</td>
	                      </tr>
	                      <tr>
		                      <td><b>Auction Ended on:</b></td>
		                      <td>{{$auctionResult[0]->endDate}}</td>
	                      </tr>
	                  </tbody>
	              </table>
	            </div>
		  	</div>
		  </div>
		  <center><div class="alert alert-success" role="alert">Congratulations to the Winner and Thanks to all who participated this auction. Watch out for <a href="http://digisells.com/auction-listings"><i>MORE!</i></a> </div></center>
		  </div>
		</div>
	</div>
</div>