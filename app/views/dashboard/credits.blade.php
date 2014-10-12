@extends('layouts.master')
@section('meta-title','Credits')
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
                      <h4 class="capital"><b>Your Credit History</h4></b>
                    </div>
                    <div class="col-md-2">
                    </div>
                  </div>
                </div>  
                <div class="panel-body">
                <div class="table-responsive"> 
                  <table class="table table-striped table-bordered table-hover auctions">
                    <thead>
                      <tr>
                        <th>Event Name</th>
                        <th>Type</th>
                        <th>Amt. Purchased</th>
                        <th>Credits Earned</th>
                        <th>Credits Used</th>
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
                            <td>{{dateformat($credits->created_at)}} {{timeformat($credits->created_at)}}</td>
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
        "order": [[ 0, "desc" ]]
    });
    });
</script>
@stop