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
              <div class="container">
                <center>
                  @if (Session::has('flash_message'))
                    <div class="form-group ">
                      <p>{{Session::get('flash_message') }}</p>
                    </div>
                  @endif
                </center>
              </div>
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
                        <!-- duration modal -->
                          <div class="modal fade duration-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                            <div class="modal-dialog modal-sm">
                              <div class="modal-content modal-prop">
                                <center>
                                  <div class="well">
                                    {{ Form::model($auction, ['method'=>'PATCH','route' => ['auction.update', $auction->id]]) }}
                                    <button type="submit" class="btn btn-warning btn-lg btn-block" name ="end" value="end">End this Auction now</button>
                                    <button type="button" class="btn btn-primary btn-lg btn-block edit-end-date">Edit End Date</button>
                                      <div class="form-group new-endDate">
                                        <br>
                                            <label>Enter New Date</label>
                                            <input class="form-control" type="text" name="endDate" placeholder="YYYY-mm-dd">
                                            <br>
                                            <button type="submit" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-check">&nbsp;</span>Update</button>
                                      </div>
                                    <button type="submit" class="btn btn-danger btn-lg btn-block" name ="cancel" value="cancel" style="margin-top:5px;">Cancel this Auction</button>
                                    <br>
                                    <hr class="style-fade">
                                    <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Close</button>
                                    {{ Form::close() }}
                                  </div>
                              </center>
                                <center><span class="glyphicon glyphicon-ok saved"></span><h4 class="saving"></h4></center>
                              </div>
                            </div>
                          </div>
                        <!-- duration modal end -->
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