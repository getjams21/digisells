@extends('layouts.master')
@section('meta-title','Funds')
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
                    <div class="col-md-12"><br>
                      @if (Session::has('flash_message'))
                        <div class="form-group ">
                          <p>{{Session::get('flash_message') }}</p>
                        </div>
                      @endif
                      <h4 class="capital"><b>FUND Activity History</h4></b>
                      <a href="/payment/create"><button type="button" class="btn btn-primary btn-lg" ><span class="glyphicon glyphicon-star-empty"></span>ADD FUNDS</button></a>
                      <br><br>
                      <hr class="style-fade">
                      <table class="table table-hover table-striped">
                          <tr>
                            <th>Fund Number</th>
                            <th>Method</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Sales Id</th>
                            <th>Bidding Id</th>
                          </tr>
                          @foreach($fund as $funds)
                            <tr>
                                <td>{{$counter++}}</td>
                                <td>{{$funds->methodName}}</td>
                                <td>{{$funds->amountAdded+$funds->amountDeducted." USD"}}</td>
                                <td>{{$funds->created_at}}</td>
                                <td>@if($funds->salesID)
                                    {{$funds->salesID}}
                                    @else
                                    NONE
                                    @endif
                                </td>
                                <td>@if($funds->biddingID)
                                    {{$funds->biddingID}}
                                    @else
                                    NONE
                                    @endif</td>
                            </tr> 
                          @endforeach
                      </table>
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