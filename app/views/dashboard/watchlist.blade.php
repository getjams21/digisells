@extends('layouts.master')
@section('meta-title','Watchlist')
@section('header')
	@include('includes.navbar')
@stop
@section('content')
<div clas="row" >
  <div id="wrapper">
    @include('dashboard.includes.dashboardNavbar')
      <div id="page-content-wrapper">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12 shadowed">
              <div class=""><br>
                   <h4 class="capital"><b>Listings you're watching</h4></b><br>
                   <hr class="style-fade"><br>
                     <!--  <table class="table table-hover">
                          <tr>
                            <th>Invoice Number</th>
                            <th>Qty</th>
                            <th>Amount</th>
                            <th>Date</th>
                          </tr>
                          <tr>
                            <td colspan="4"></td>
                          </tr>
                      </table> -->
                    <b><h4>You're not watching any Listings yet.</h4> </b> 
                    <b><h3><small>Watching a listing is the best way to stay up to date with the progress of multiple auctions and make sure you don't miss that perfect deal!</small> </h3></b> 
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
</div>  
@stop