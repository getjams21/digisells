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
                  <ul class="nav nav-tabs" role="tablist">
                          <li class="active"><a href="#auctionList" role="tab" data-toggle="tab"><h5><b><i>Auction</i></b></h5></a></li>
                          <li><a href="#directSellingList" role="tab" data-toggle="tab"><h5><b><i>Direct Selling</i></b></h5></a></li>
                      </ul>
                        <!-- Tab panes -->
                      <div class="tab-content">
                          <div class="tab-pane active" id="auctionList">
                              @include('dashboard.includes.auctionList') 
                          </div>
                          <div class="tab-pane" id="directSellingList">
                              @include('dashboard.includes.directSellingList') 
                          </div>
                      </div>
                    <h3><small>You don't have any Listings with Digisells just yet.</small></h3>
            </div>
          </div>
        </div>
      </div>
  </div>
</div>  
@stop