@extends('layouts.master')
@section('meta-title','Dashboard')
@section('header')
	@include('includes.navbar')
@stop
@section('content')
	<div clas="row" >
		<div id="wrapper">
		@include('users.includes.dashboardNavbar')
		 <!-- Page Content -->
        <div id="page-content-wrapper">
        	<!-- <a href="#menu-toggle" class="btn btn-primary pull-left " id="menu-toggle" ><b><</b></a> -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12" id="showContent">
                        	@include('users.includes.profile')
                           <!--  @include('users.includes.activities') -->
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->
		</div>
	</div>	
@stop