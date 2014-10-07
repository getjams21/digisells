@extends('layouts.master')
@section('meta-title','Edit')
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
                  	<!-- Nav tabs -->
						<ul class="nav nav-tabs" role="tablist">
						  <li class="active"><a href="#editProfileInfo" role="tab" data-toggle="tab"><h5><b><i>Personal</i></b></h5></a></li>
						  <li ><a href="#editPaypalInfo" role="tab" data-toggle="tab"><h5><b><i>Paypal</i></b></h5></a></li>
						  <li><a href="#editAccountInfo" role="tab" data-toggle="tab"><h5><b><i>Account</i></b></h5></a></li>
						</ul>
						<!-- Tab panes -->
						<div class="tab-content">
						  <div class="tab-pane active" id="editProfileInfo">
								 @include('users.includes.editProfile')	
						  </div>
						  <div class="tab-pane " id="editPaypalInfo">
								 @include('users.includes.editPaypal')	
						  </div>
						  <!-- <div class="tab-pane" id="editContactInfo">Contacts</div> -->
						 <div class="tab-pane" id="editAccountInfo">
						  		@include('users.includes.editAccountInfo')	
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