@extends('admin.master.layout')
@section('meta-title','Auction_Sales')
@section('content')
      <div class="row">
          <div class="col-lg-12">
              <h1 class="page-header">Auction Sales</h1>
          </div>
          <!-- /.col-lg-12 -->
      </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-10">
                              <h4 class="capital"><b>Auction Sales</b></h4>
                            </div>
                            <div class="col-md-2">
                            </div>
                          </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="datalist">
                                    <thead>
                                        <tr>
                                            <th>Auction Name</th>
			                                <th>Min. Prc</th>
			                                <th>Buyout Prc</th>
			                                <th>Bids</th>
			                                <th>Amt. Sold</th>
                                            <th>Company</th>
                                            <th>Credits</th>
                                            <th>Seller</th>
                                            <th>Aff. %</th>
                                            <th>Aff. Amt.</th>
			                                <th>Buyer</th>
                                            <th>Seller</th>
                                            <th>Affiliate</th>
			                                <th>Date Sold</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         @foreach($auctionSales as $auctionSales)
			                               <tr>
			                              	<td><a href="/auction-listing/{{$auctionSales->auctionID}}">{{$auctionSales->auctionName}}</a> </td>
			                              	<td><i class="fa fa-usd"></i> {{money($auctionSales->minimumPrice)}}</td>
			                              	<td><i class="fa fa-usd"></i> {{money($auctionSales->buyoutPrice)}}</td>
			                              	<td>{{$auctionSales->bidders}}</td>
			                              	<td><i class="fa fa-usd"></i> {{money($auctionSales->amount)}}</td>
                                            <td><i class="fa fa-usd"></i> <i>{{money($auctionSales->amount * .09)}}</i></td>
                                            <td><span class="glyphicon glyphicon-certificate"></span> {{money($auctionSales->amount * .01)}}</i></td>
                                            <td>
                                                @if($auctionSales->affiliateID)
                                                <i class="fa fa-usd"></i> <i>{{money(($auctionSales->amount * .9) - (($auctionSales->amount)*($auctionSales->affiliatePercentage / 100)))}}</i>
                                                @else
                                                   <i class="fa fa-usd"></i><i> {{money($auctionSales->amount * .9)}}</i> 
                                                   @endif
                                            </td>
                                            <td>{{$auctionSales->affiliatePercentage}} %</td>
                                            <td>@if($auctionSales->affiliateID)
                                                <i class="fa fa-usd"></i> 
                                                {{money(($auctionSales->amount)*($auctionSales->affiliatePercentage / 100))}}</td>
                                                @else
                                                <i class="fa fa-usd"></i> 0.00
                                                @endif
			                                <td><a href="/users/{{$auctionSales->username}}">{{$auctionSales->firstName}}</a> </td>
                                            <td><a href="/users/{{$auctionSales->sellerUsername}}"> {{$auctionSales->sellerFirstname}}</a></td>
                                            <td>@if($auctionSales->affiliateID) 
                                                <a href="/users/{{$auctionSales->affUsername}}"> {{$auctionSales->affFirstname}}</a>
                                                @else
                                                <i>N/A</i>
                                                @endif
                                            </td>
			                   <!-- -->	    <td>{{dateformat($auctionSales->created_at)}} {{timeformat($auctionSales->created_at)}}</td>
			                              </tr>
			                            @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                            <!-- <div class="well">
                                <h4>DataTables Usage Information</h4>
                                <p>DataTables is a very flexible, advanced tables plugin for jQuery. In SB Admin, we are using a specialized version of DataTables built for Bootstrap 3. We have also customized the table headings to use Font Awesome icons in place of images. For complete documentation on DataTables, visit their website at <a target="_blank" href="https://datatables.net/">https://datatables.net/</a>.</p>
                                <a class="btn btn-default btn-lg btn-block" target="_blank" href="https://datatables.net/">View DataTables Documentation</a>
                            </div> -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
@section('script')
<script type="text/javascript">
    $(document).ready(function() {
            $('#datalist').dataTable({
            "order": [[ 0, "asc" ]]
        });
        });
</script>
@stop
@stop