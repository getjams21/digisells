@extends('layouts.master')
@section('meta-title', $event)
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
                   <h4 class="capital"><b>Listings {{$event}}</h4></b><br>
                   @include('dashboard.includes.watchlist')
                    @if(!$watchlists)
                    <b><h4>You're not watching any Listings yet.</h4> </b> 
                    <b><h3><small>Watching a listing is the best way to stay up to date with the progress of multiple auctions and make sure you don't miss that perfect deal!</small> </h3></b> 
                    @endif
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
</div>  
@stop