@extends('layouts.master')
@section('meta-title','Notifications')
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
              <div class="">
                   @include('dashboard.includes.notifications')
              
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
</div>  
@stop