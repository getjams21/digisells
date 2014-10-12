@extends('layouts.master')
@section('meta-title','Deposits')
@section('header')
	@include('includes.navbar')
@stop
@section('content')
<div clas="row" >
    <div id="wrapper" >
    @include('dashboard.includes.dashboardNavbar')
     <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                  <div class="col-md-12 shadowed">
                    <div class="col-md-12"><br>
                      @if (Session::has('flash_message'))
                        <div class="form-group ">
                          <p>{{Session::get('flash_message') }}</p>
                        </div>
                      @endif
                    <div class="panel panel-primary">
                     <div class="panel panel-heading">
                        <div class="row">
                          <div class="col-md-3">
                              <a href="/payment/create"><button type="button" class="btn btn-info btn-lg" style="white-space: normal;"><span class="glyphicon glyphicon-plus"></span> <b> ADD FUNDS</b></button></a>
                          </div>
                          <div class="col-md-6">
                            <h4 class="capital" align="center" style="margin-top:16px;"><b>FUNDS DEPOSIT HISTORY</h4></b>
                          </div>
                          <div class="col-md-3" style="padding-top:5px;">
                             <h5  align="center"><b>Current FUND:  {{Auth::user()->fund}} USD</h5></b>
                          </div>
                        </div>
                      </div>   
                      <div class="panel-body">
                      <div class="table-responsive" >
                      <table class="table table-striped table-bordered table-hover funds">
                        <thead>
                          <tr>
                            <th>Method</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Invoice</th>
                          </tr>
                          </thead>
                          <tbody>
                          @foreach($fund as $funds)
                            <tr>
                                <td>{{$funds->methodName}}</td>
                                <td><i> {{$funds->amount." USD"}}</i></td>
                                <td>{{dateformat($funds->created_at)}} at {{timeformat($funds->created_at)}}</td>
                                <td>
                                  <b><i style="color:green;" class="fa fa-check-circle"></i><i> Completed</i></b>
                                </td>
                                <td>
                                  <a href="payment/{{$funds->paymentID}}"><button class="btn btn-info btn-xs">Invoice</button></a>
                                </td>
                            </tr> 
                          @endforeach
                        </tbody>
                      </table>
                      </div>
                      </div>
                      </div>
                      <!-- <h3><small>No FUND Activities yet...</small></h3> -->
                       <br>
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
        $('.funds').dataTable( {
        "order": [[ 2, "desc" ]]
    });
    });
</script>
@stop