@extends('layouts.master')
@section('meta-title','Profile')
@section('header')
	@include('includes.navbar')
@stop
@section('content')
	<div clas="row" >
  <div id="wrapper">
      @if(Auth::user())
       @include('dashboard.includes.dashboardNavbar')
      @endif
      <div id="page-content-wrapper"> 
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12 shadowed"><br>
              <div class="col-md-12">
               <div class="row shadowed" id="Profile" >
                  @include('users.includes.profile')
               </div>
                    <br>
                <div class="row" >
                    <div class="col-md-3 pull-left" id="profileHistory" style="padding-left:0;">
                      <div class="col-md-12 pull-left shadowed">
                     <h4><small><b>History</b></small></h4>
                        <hr  class="style-fade">
                         <h5>No Activities yet</h5>
                      </div>   
                    </div>
                    <div class="col-md-9 shadowed" id="profileFeedbacks" >
                  <!-- Nav tabs -->
                     <ul class="nav nav-tabs" role="tablist">
                        <li class="active"><a href="#listings" role="tab" data-toggle="tab"><h5><b><i>Listings</i></b></h5></a></li>
                        <li><a href="#feedbacks" role="tab" data-toggle="tab"><h5><b><i>Feedbacks</i></b></h5></a></li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                          <div class="tab-pane active" id="listings">
                                <h5>No listings created yet</h5>
                          </div>
                          <div class="tab-pane" id="feedbacks">
                                <h5>No feedbacks yet</h5>
                          </div>
                        </div>
                    </div>
                </div>
            </div><!--12-->
          </div><!--shadowed-->
        </div><!--row-->
      </div>
    </div><!--page-content-->
  </div><!--wrapper-->
</div>  <!--row-->
@stop

