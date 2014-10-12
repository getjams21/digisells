@extends('admin.master.layout')
@section('meta-title','Active_Biddings')
@section('content')
      <div class="row">
          <div class="col-lg-12">
              <h1 class="page-header">Bidding Events</h1>
          </div>
          <!-- /.col-lg-12 -->
      </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-10">
                              <h4 class="capital"><b>Active Biddings</b></h4>
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
                                            <th>Min. Price</th>
                                            <th>Buyout Price</th>
                                            <th>Max Bid</th>
                                            <th>Auto Bid</th>
                                            <th>Bidder</th>
                                            <th>Bid Date</th>
                                            <th>Auction End Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         @foreach($bidding as $bidding)
			                              <tr>
                                      <td><a href="auction-listing/{{$bidding->id}}"> {{$bidding->auctionName}}</a></td>
                                      <td>{{money($bidding->minimumPrice)}}</td>
                                      <td><i class="fa fa-usd"></i> 
                                        {{money($bidding->buyoutPrice)}}</td>
                                      <td><i class="fa fa-usd"></i> 
                                        {{money($bidding->amount)}}</td>
                                      <td>@if($bidding->maxBid == 0.0000)
                                        Not Set
                                        @else
                                        {{money($bidding->maxBid)}}</td>
                                        @endif
                                      <td><a href="/users/{{$bidding->bidderUsername}}"> {{$bidding->maxBidder}}</a></td>
                                      <td>{{human($bidding->date)}}</td>
                                      <td>{{human($bidding->endDate)}}</td>
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