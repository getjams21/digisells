@extends('layouts.master')
@section('meta-title','Bids')
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
                      <h4 class="capital"><b><a href="/users/{{Auth::user()->username}}">{{ Auth::user()->username }}'s</a> Bid History</h4></b>
                      <hr >

                      <ul class="nav nav-tabs" role="tablist">
                          <li class="active"><a href="#wonBids" role="tab" data-toggle="tab"><h5><b><i>Won Biddings</i></b></h5></a></li>
                          <li><a href="#inactiveBids" role="tab" data-toggle="tab"><h5><b><i>Inactive Biddings</i></b></h5></a></li>
                      </ul>

                        <!-- Tab panes -->
                      <div class="tab-content">
                          <div class="tab-pane active" id="wonBids">
                              @include('dashboard.includes.wonBidsPartial') 
                          </div>
                          <div class="tab-pane" id="inactiveBids">
                              @include('dashboard.includes.inactiveBidsPartial') 
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