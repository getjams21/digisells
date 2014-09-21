@extends('layouts.master')
@section('meta-title','Sold D-Selling')
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
                      <div class="panel-heading"><h4><b>Sold Auctions</b></h4>
                     </div>  
                      <div class="panel-body">
                        <div class="table-responsive" >
                          <table class="table table-striped table-bordered table-hover" id="soldAuctions">
                            <thead>
                              <tr>
                                <th>Selling Name</th>
                                <th>Price</th>
                                <th>Discount</th>
                                <th>Amount Sold</th>
                                <th>Qty Sold</th>
                                <th>Event End</th>
                                <th>Status</th>
                              </tr>
                             </thead> 
                             <tbody>
                           		@foreach($soldSelling as $soldSelling)
                              <tr>
                              	<td><a href="/direct-selling/{{$soldSelling->sellingID}}"> {{$soldSelling->sellingName}}</a></td>
                                <td>{{round($soldSelling->price,2)}}</td>
                                <td>{{$soldSelling->discount}}</td>
                                <td><b> {{round($soldSelling->amount,2)}}</b></td>
                              	<td>{{$soldSelling->buyers}}</td>
                              	<td>{{dateformat($soldSelling->endDate)}} at {{timeformat($soldSelling->endDate)}}</td>
                                <td>@if(carbonize($soldSelling->endDate) > Carbon::now())
                                  <span class="alert alert success"> <i class="fa fa-play-circle"></i> Active</span>
                                  @else
                                   <span class="alert alert danger"> <i class="fa fa-stop"></i> Ended</span>
                                  @endif
                                </td>
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
        $('#soldAuctions').dataTable( {
        "order": [[ 3, "desc" ]]
    });
    });
</script>
@stop 