@extends('layouts.master')
@section('meta-title','Listings')
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
                  <h4 class="capital"><b><a href="/users/{{Auth::user()->username}}">{{ Auth::user()->username }}'s</a> Listings</h4></b><br>
                  <hr class="style-fade">
                      <table class="table table-hover">
                          <tr>
                            <th>Listing Number</th>
                            <th>Qty</th>
                            <th>Amount</th>
                            <th>Bids</th>
                            <th>Status</th>
                            <th>Date</th>
                          </tr>
                          <tr>
                            <td colspan="6"></td>
                          </tr>
                      </table>
                    <h3><small>You don't have any Listings with Digisells just yet.</small></h3>
            </div>
          </div>
        </div>
      </div>
  </div>
</div>  
@stop