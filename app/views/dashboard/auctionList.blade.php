@extends('layouts.master')
@section('meta-title','Auctions')
@section('header')
	@include('includes.navbar')
@stop
@section('content')
<div class="modal fade duration-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-sm">
    <div class="modal-content modal-prop">
      <center>
        <div class="well">
          {{ Form::open(['POST'=>'edit-auction-duration']) }}
          <button type="submit" class="btn btn-danger btn-lg"><span class="glyphicon glyphicon-check">&nbsp;</span>Stop</button>
            <div class="form-group row">
              <div class="col-xs-8">
                <div class="input-group date txtbox-m" id="grp-endDate" data-date="" data-date-format="mm-dd-yyyy">
                  <input class="form-control" type="text" id="endDate" name="endDate" readonly required>
                  <input type="hidden" name="auctionID" value="">
                  <span class="input-group-addon calendar-icon"><i class="glyphicon glyphicon-calendar"></i></span>
                </div>
              </div>
            </div>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-check">&nbsp;</span>Update</button>
          {{ Form::close() }}
        </div>
    </center>
      <center><span class="glyphicon glyphicon-ok saved"></span><h4 class="saving"></h4></center>
    </div>
  </div>
</div>
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
                        <th>Event Created</th>
                        <th>Event End</th>
                        <th>Status</th>
                        <th>Settings</th>
                      </tr>
                     </thead> 
                     <tbody>
                        @foreach($auction as $auction)
                          <tr>
                            <td><a href="/auction-listing/{{$auction->id}}">{{$auction->auctionName}}</a> </td>
                            <td><i class="fa fa-usd"></i> 
                              {{money($auction->minimumPrice)}}</td>
                            <td><i class="fa fa-usd"></i> 
                              {{money($auction->buyoutPrice)}}</td>
                            <td>{{$auction->bidders}}</td>
                            <td><i class="fa fa-usd"></i> 
                              {{money($auction->maxBid)}}</td>
                            <td>
                              @if($auction->maxBidder)
                              <a href="/users/{{$auction->username}}"> {{$auction->maxBidder}}</a>
                              @else
                              N/A
                              @endif
                            </td>
                            <td>{{Human($auction->datebid)}}</td>
                            <td>{{human($auction->created_at) }} </td>
                            <td>{{human($auction->endDate) }}</td>
                            <td>
                              @if(carbonize($auction->endDate) > Carbon::now())
                                  <span class="success"> <i class="fa fa-play-circle"></i> Active</span>
                              @else
                                   <span class="error"> <i class="fa fa-stop"></i> Expired</span>
                              @endif
                            </td>
                            <td><center><button class="btn btn-success btn-xs glyphicon glyphicon-cog" type="button" id="btn-settings" value="{{$auction->id}}"></center></button> </td>
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