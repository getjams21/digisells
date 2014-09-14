@extends('layouts.master')
@section('meta-title','Withdrawals')
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
                              <a href="/withdrawal/create"><button type="button" class="btn btn-info btn-lg" style="white-space: normal;"><span class="glyphicon glyphicon-minus"></span> <b> WITHDRAW</b></button></a>
                          </div>
                          <div class="col-md-6">
                            <h4 class="capital" align="center" style="margin-top:16px;"><b>FUNDS WITHDRAWAL HISTORY</h4></b>
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
                            <th>Email</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Status</th>
                          </tr>
                          </thead>
                        <tbody>
                            @foreach($withdrawals as $withdrawal)
                            <tr class="clickableRow" href="withdrawal/{{$withdrawal->paykey}}">
                                <td>{{$withdrawal->email}}</td>
                                <td><i>{{$withdrawal->amount." USD"}}</i></td>
                                <td>{{dateformat($withdrawal->created_at)}} at {{timeformat($withdrawal->created_at)}}</td>
                                <td><b style="color:green;"><i>COMPLETED</i></b></td>
                            </tr> 
                          @endforeach
                          {{$withdrawals->links()}}
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