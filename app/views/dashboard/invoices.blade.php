@extends('layouts.master')
@section('meta-title','Invoices')
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
                    @include('dashboard.includes.invoicesPartial')

                  </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->
    </div>
  </div>  
@stop