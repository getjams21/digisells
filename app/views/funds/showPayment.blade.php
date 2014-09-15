@extends('layouts.master')
@section('meta-title','Deposits')
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
                @include('funds.includes.paymentInvoice')
            </div>
        </div>
        <!-- /#page-content-wrapper -->
    </div> 
  </div>  
@stop









<!--  -->


