@extends('layouts.master')
@section('meta-title','Sold Auction')
@section('header')
	@include('includes.navbar')
@stop
@section('content')
<div clas="row" >
    <div id="wrapper">
    @include('dashboard.includes.dashboardNavbar')
     <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                  <div class="col-md-12 shadowed">
                    <div class=""><br>
                        <div class="col-md-12"><br>
                     <div class="panel panel-primary">
                      <div class="panel-heading"><h4><b>Sold Auctions</b></h4></div>  
                      <div class="panel-body">
                        <div class="table-responsive" >
                          <table class="table table-striped table-bordered table-hover" id="soldAuctions">
                            <thead>
                              <tr>
                                <th>Auction Name</th>
                                <th>Min. Price</th>
                                <th>Buyout Price</th>
                                <th>Bids</th>
                                <th>Amount Sold</th>
                                <th>Deductions</th>
                                <th>Aff. %</th>
                                <th>Aff. Amt.</th>
                                <th>Affiliate</th>
                                <th>Net Profit</th>
                                <th>Buyer</th>
                                <th>Date Sold</th>
                              </tr>
                             </thead> 
                             <tbody>
                           		@foreach($soldAuctions as $soldAuction)
                              <tr>
                              	<td><a href="/auction-listing/{{$soldAuction->auctionID}}">{{$soldAuction->auctionName}}</a> </td>
                              	<td><i class="fa fa-usd"></i> {{money($soldAuction->minimumPrice)}}</td>
                              	<td><i class="fa fa-usd"></i> {{money($soldAuction->buyoutPrice)}}</td>
                              	<td>{{$soldAuction->bidders}}</td>
                              	<td><i class="fa fa-usd"></i><i> {{money($soldAuction->amount)}}</i></td>
                                <td><i class="fa fa-usd"></i><i class="error"> {{money($soldAuction->amount * .10)}}</i></td>
                                <td>{{$soldAuction->affiliatePercentage}} %</td>
                                <td>@if($soldAuction->affiliateID)
                                      <i class="fa fa-usd"></i> <i>{{ money($soldAuction->amount * ($soldAuction->affiliatePercentage / 100))}}</i> 
                                    @else
                                      <i>N/A</i>
                                    @endif
                                </td>
                                <td>@if($soldAuction->affiliateID)
                                   <a href="/users/{{$soldAuction->affUsername}}"> {{$soldAuction->affFirstName}}</a>
                                    @else
                                      <i>N/A</i>
                                    @endif</td>
                                <td>
                                    @if($soldAuction->affiliateID)
                                   <i class="fa fa-usd"></i><i class="success">{{money(($soldAuction->amount - ($soldAuction->amount * .10)) - 
                                      ($soldAuction->amount * ($soldAuction->affiliatePercentage / 100)))}}</i> 
                                    @else
                                    <i class="fa fa-usd"></i> <i class="success">{{money($soldAuction->amount - ($soldAuction->amount * .10))}}</i>
                                    @endif
                                </td>
                                <td><a href="/users/{{$soldAuction->username}}">{{$soldAuction->firstName}}</a> </td>
                              	<td>{{dateformat($soldAuction->created_at)}} {{timeformat($soldAuction->created_at)}}</td>
                              </tr>
                              @endforeach
                            </tbody>
                          </table>
                      </div>
                    </div>
                  </div>
                 </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->
    </div>
  </div>  
@stop
@section('script')
<script type="text/javascript">
   $(document).ready(function() {
        $('#soldAuctions').dataTable( {
        "order": [[ 3, "desc" ]]
    });
    });
</script>
@stop 