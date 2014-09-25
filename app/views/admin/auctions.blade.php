@extends('admin.master.layout')
@section('meta-title','Auction_List')
@section('content')
      <div class="row">
          <div class="col-lg-12">
              <h1 class="page-header">Auction Events</h1>
          </div>
          <!-- /.col-lg-12 -->
      </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-10">
                              <h4 class="capital"><b><?php if($expired ==1){echo 'Expired';}else{ echo 'Current';}?> Auction List</h4></b>
                            </div>
                            <div class="col-md-2">
                              <select class="form-control" onchange="location = this.options[this.selectedIndex].value;">
                                 <option value="/admin-auctions?expired=0">Current</option>
                                 <option value="/admin-auctions?expired=1" <?php if($expired ==1){echo 'selected';}?>>Expired</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="userlist">
                                    <thead>
                                        <tr>
                                            <th>Auction Name</th>
                                            <th>Min. Price</th>
                                            <th>Buyout Price</th>
                                            <th>Aff. %</th>
                                            <th>Bids</th>
                                            <th>Max Bid</th>
                                            <th>Max Bidder</th>
                                            <th>Event Created</th>
                                            <th>Event End</th>
                                            <th>Seller</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         @foreach($auctions as $auction)
			                              <tr>
                                            <td><a href="/auction-listing/{{$auction->id}}">{{$auction->auctionName}}</a> </td>
                                            <td><i class="fa fa-usd"></i> 
                                              {{money($auction->minimumPrice)}}</td>
                                            <td><i class="fa fa-usd"></i> 
                                              {{money($auction->buyoutPrice)}}</td>
                                            <td> {{$auction->affiliatePercentage}}</td>
                                            <td>{{$auction->bidders}}</td>
                                            <td>
                                                @if($auction->minimumPrice==$auction->maxBid)
                                                N/A
                                                @else
                                              <i class="fa fa-usd"></i>  {{money($auction->maxBid)}}
                                              @endif
                                            </td>
                                            <td>
                                              @if($auction->maxBidder)
                                              <a href="/users/{{$auction->username}}"> {{$auction->maxBidder}}</a>
                                              @else
                                              N/A
                                              @endif
                                            </td>
                                            <td>{{human($auction->created_at) }} </td>
                                            <td>{{human($auction->endDate) }}</td>
                                            <td><a href="/users/{{$auction->sellerUsername}}">{{$auction->seller }}</a> </td>
                                            <td>
                                              @if(carbonize($auction->endDate) > Carbon::now())
                                                  <span class="success"> <i class="fa fa-play-circle"></i> Ongoing</span>
                                              @else
                                                   <span class="error"> <i class="fa fa-stop"></i> Expired</span>
                                              @endif
                                            </td>
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
        $('#userlist').dataTable();
    });
</script>
@stop
@stop