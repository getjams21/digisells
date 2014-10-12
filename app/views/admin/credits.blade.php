@extends('admin.master.layout')
@section('meta-title','Credits')
@section('content')
      <div class="row">
          <div class="col-lg-12">
              <h1 class="page-header">Credits</h1>
          </div>
          <!-- /.col-lg-12 -->
      </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-10">
                              Credits List
                            </div>
                            <div class="col-md-2">
                              
                            </div>
                          </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="userlist">
                                    <thead>
                                        <tr>
                                            <th>Event Name</th>
                                            <th>Type</th>
                                            <th>Amt. Purchased</th>
                                            <th>Credits Earned</th>
                                            <th>Credits Used</th>
                                            <th>Buyer</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         @foreach($credits as $credits)
			                                   <tr>  
                                           <td>@if($credits->sellingName)
                                            <a href="/direct-selling/{{$credits->sellingID}}">{{$credits->sellingName}}</a> 
                                              @else
                                            <a href="/auction-listing/{{$credits->auctionID}}">{{$credits->auctionName}}</a>
                                              @endif
                                           </td>
                                          <td>@if($credits->sellingName)
                                            Direct Selling
                                              @else
                                            Auction
                                              @endif
                                          </td>
                                          <td> <i class="fa fa-usd"></i> {{money($credits->amount)}}</td>
                                          <td><span class="glyphicon glyphicon-certificate"></span> <i class="success"> {{money($credits->creditAdded)}}</i></td>
                                          <td><span class="glyphicon glyphicon-certificate"></span> <i class="error"> {{money($credits->creditDeducted)}}</i></td>
                                          <td>
                                          <a href="/users/{{$credits->username}}"> {{$credits->firstName}}</a>
                                          </td>    
                                          <td>{{dateformat($credits->created_at)}} {{timeformat($credits->created_at)}}</td> 

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