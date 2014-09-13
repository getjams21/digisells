@extends('admin.master.layout')
@section('meta-title',$body)
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
                            @if($expired == 1)Expired 
                            @elseif($status==1) Sold
                            @else Current
                            @endif Auctions
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="userlist">
                                    <thead>
                                        <tr>
                                            <th>Auction Name</th>
                                            <th>Product Name</th>
                                            <th>Minimum Price</th>
                                            <th>Buyout Price</th>
                                            <th>Increment</th>
                                            <th>Affiliate %</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         @foreach($auctions as $auction)
			                              <tr> 
			                                <td>{{$auction->auctionName}}</td>
			                                <td>{{$auction->productName}}</td>
			                                <td>{{$auction->minimumPrice}}</td>
			                                <td>{{$auction->buyoutPrice}}</td>
                                            <td>{{$auction->incrementation}}</td>
                                            <td>{{$auction->affiliatePercentage}}</td>
			                                <td>{{dateformat($auction->startDate)}} at {{timeformat($auction->startDate)}}</td>
                                            <td>{{dateformat($auction->endDate)}} at {{timeformat($auction->endDate)}}</td>
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