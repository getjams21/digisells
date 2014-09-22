@extends('layouts.master')
@section('meta-title','Active')
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
                      <div class="panel-heading"><h4><b>Active Bids</b></h4></div>  
                      <div class="panel-body">
                        <div class="table-responsive" >
                          <table class="table table-striped table-bordered table-hover" id="activebids">
                            <thead>
                              <tr>
                                <th>Auction Name</th>
                                <th>Amount Bid</th>
                                <th>Max Bid</th>
                                <th>Buyout Price</th>
                                <th>Bid Date</th>
                                <th>Auction End Date</th>
                              </tr>
                             </thead> 
                             <tbody>
                              @foreach($activebids as $activebid)
                              <tr>
                                <td><a href="auction-listing/{{$activebid->id}}"> {{$activebid->auctionName}}</a></td>
                                <td>{{$activebid->amount}}</td>
                                <td>@if($activebid->maxBid == 0.0000)
                                  Not Set
                                  @else
                                  {{$activebid->maxBid}}</td>
                                  @endif
                                <td>{{$activebid->buyoutPrice}}</td>
                                <td>{{human($activebid->date)}}</td>
                                <td>{{human($activebid->endDate)}}</td>
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
        $('#activebids').dataTable( {
        "order": [[ 4, "desc" ]]
    });
    });
</script>
@stop 