@extends('layouts.master')
@section('meta-title','Withdrawals')
@section('header')
    @include('includes.navbar')
@stop
@section('content')
<div clas="row" >
    <div id="wrapper">
    @include('dashboard.includes.dashboardNavbar')
     <!-- Page Content -->
        <div id="page-content-wrapper">
             @include('funds.includes.showWithdrawalPartial')   
        </div>
        <!-- /#page-content-wrapper -->
    </div>
  </div>  
@stop









<!--  -->



               