@extends('layouts.master')
@section('meta-title','Auction')
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
                 <div class="col-md-12 shadowed"><br>
                <div class="panel panel-primary">
                <div class="panel-heading"><h4 class="capital"><b>Your Auction List</h4></b></div>
                <div class="panel-body">
                <div class="table-responsive"> 
                  <table class="table table-striped table-bordered table-hover auctions">
                    <thead>
                      <tr>
                        <th>Auction Name</th>
                        <th>Qty</th>
                        <th>Amount</th>
                        <th>Bids</th>
                        <th>Last Bidder</th>
                        <th>Date</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Status</th>
                      </tr>
                     </thead> 
                     <tbody>
                        @foreach($auction as $auction)
                          <tr>
                            <td>{{$auction->auctionName}}</td>
                            <td>{{$auction->quantity}}</td>
                            <td>{{$auction->minimumPrice}}</td>
                            <td>0</td>
                            <td>None</td>
                            <td>-</td>
                            <td>{{date("d F Y",strtotime($auction->startDate)) }} at {{ date("g:ha",strtotime($auction->startDate)) }}</td>
                            <td>{{date("d F Y",strtotime($auction->endDate)) }} at {{ date("g:ha",strtotime($auction->endDate)) }}</td>
                            <td>
                              @if($auction->sold==0)
                               <p style="color:green;"><b>AVAILABLE</b></p>
                              @else
                                <p style="color:red;"><b>ENDED</b></p>
                              @endif
                            </td>
                         </tr> 
                        @endforeach
                    </tbody>
                  </table>
               </div> <!-- table-responsive -->
               </div><!--panel-body-->
               </div><!--panel-primary-->
               </div><!-- shadowed -->
              </div><!-- row -->
            </div><!-- container-fluid -->
        </div><!-- /#page-content-wrapper -->
    </div><!-- wrapper -->
  </div>  <!-- row -->
@stop
@section('script')
<script type="text/javascript">
   $(document).ready(function() {
        $('.auctions').dataTable( {
        "order": [[ 6, "desc" ]]
    });
    });
</script>
@stop