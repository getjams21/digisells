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
                      <div class="row invoice-header panel">
                          <div class="col-md-3">
                              <a href="/withdrawal/create"><button type="button" class="btn btn-info btn-lg" style="margin-top:6px;"><span class="glyphicon glyphicon-minus"></span> <b> WITHDRAW</b></button></a>
                          </div>
                          <div class="col-md-6">
                            <h3 class="capital" align="center"><b>FUNDS WITHDRAWAL HISTORY</h3></b>
                          </div>
                          <div class="col-md-3">
                          </div>
                      </div>  
                     <h4 style="color:green;"> <b>Click row to view details</b></h4>
                      <div class="table-responsive" style="border-top: 1px solid #C0C0C0;">
                      <table class="table table-hover table-striped ">
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