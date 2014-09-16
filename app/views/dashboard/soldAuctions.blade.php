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
                                <!-- <th>Bids</th> -->
                                <th>Buyout Price</th>
                                <th>Max Bidder</th>
                                <th>Amount Sold</th>
                                <th>Date Sold</th>
                            <!--     <th>Start Date</th>
                                <th>End Date</th> -->
                              </tr>
                             </thead> 
                             <tbody>
                           		@foreach($soldAuctions as $soldAuction)
                              <tr>
                              	<td>{{$soldAuction->auctionName}}</td>
                              	<!-- <td></td> -->
                              	<td>{{$soldAuction->buyoutPrice}}</td>
                              	<td>{{$soldAuction->username}}</td>
                              	<td><b>{{round($soldAuction->max,2)}}</b></td>
                              	<td>{{dateformat($soldAuction->sold)}} at {{timeformat($soldAuction->sold)}}</td><!-- 
                              	<td>{{dateformat($soldAuction->startDate)}} at {{timeformat($soldAuction->startDate)}}</td>
                              	<td>{{dateformat($soldAuction->endDate)}} at {{timeformat($soldAuction->endDate)}}</td> -->
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