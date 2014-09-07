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
                      <div class="row">
                          <div class="col-md-4">
                              <a href="/withdrawal/create"><button type="button" class="btn btn-primary btn-lg" ><span class="glyphicon glyphicon-plus"></span> <b> WITHDRAW</b></button></a>
                          </div>
                          <div class="col-md-8">
                            <h3 class="capital"><b>FUNDS WITHDRAWAL HISTORY</h3></b>
                          </div>
                      </div>  
                      <hr class="style-fade">
                     <h4 style="color:green;"> <b>Click row to view details</b></h4>
                      <div class="table-responsive" style="border-top: 1px solid #C0C0C0;">
                      <table class="table table-hover table-striped ">
                        <thead>
                          <tr>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Status</th>
                          </tr>
                          </thead>
                          <tbody>
                          
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