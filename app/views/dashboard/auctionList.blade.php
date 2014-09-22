@extends('layouts.master')
@section('meta-title','Auctions')
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
                <div class="panel-heading">
                  <div class="row">
                    <div class="col-md-10">
                      <h4 class="capital"><b>Your Auction List</h4></b>
                    </div>
                    <div class="col-md-2">
                      <select class="form-control" onchange="location = this.options[this.selectedIndex].value;">
                         <option value="/auctionList?status=current">Current</option>
                         <option value="/auctionList?status=expired" <?php if($status =='expired'){echo 'selected';}?>>Expired</option>
                      </select>
                    </div>
                  </div>
                </div>  
                <div class="panel-body">
                <div class="table-responsive"> 
                  <table class="table table-striped table-bordered table-hover auctions">
                    <thead>
                      <tr>
                        <th>Auction Name</th>
                        <th>Min. Price</th>
                        <th>Buyout Price</th>
                        <th>Bids</th>
                        <th>Max Bid</th>
                        <th>Max Bidder</th>
                        <th>Date</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Status</th>
                      </tr>
                     </thead> 
                     <tbody>
                        @foreach($auction as $auction)
                          <tr>
                            <td><a href="/auction-listing/{{$auction->id}}">{{$auction->auctionName}}</a> </td>
                            <td>{{round($auction->minimumPrice,2)}}</td>
                            <td>{{round($auction->buyoutPrice,2)}}</td>
                            <td>{{$auction->bidders}}</td>
                            <td>{{round($auction->maxBid,2)}}</td>
                            <td>
                              @if($auction->maxBidder)
                              <a href="/users/{{$auction->username}}"> {{$auction->maxBidder}}</a>
                              @else
                              N/A
                              @endif
                            </td>
                            <td>{{Human($auction->datebid)}}</td>
                            <td>{{human($auction->startDate) }} </td>
                            <td>{{human($auction->endDate) }}</td>
                            <td>
                              @if(carbonize($auction->endDate) > Carbon::now())
                                  <span class="success"> <i class="fa fa-play-circle"></i> Active</span>
                              @else
                                   <span class="error"> <i class="fa fa-stop"></i> Expired</span>
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
        "order": [[ 8, "desc" ]]
    });
    });
</script>
@stop