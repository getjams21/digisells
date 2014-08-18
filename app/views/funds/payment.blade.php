@extends('layouts.master')
@section('meta-title','Funds')
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
                    <div class="col-md-12"><hr>
                      <h4 class="capital" style="color:#254117;"><b><i>Add your Funds to purchase products</i></b></h4>
                      <hr>
                    <ul class="nav nav-tabs" role="tablist">
                          <li class="active"><a href="#creditCard" role="tab" data-toggle="tab"><h5><b><i>Credit Card</i></b></h5></a></li>
                          <li><a href="#paypal" role="tab" data-toggle="tab"><h5><b><i>Paypal</i></b></h5></a></li>
                      </ul>
                        <!-- Tab panes -->
                      <div class="tab-content">
                      <div class="tab-pane active" id="creditCard">
                            <!-- CREDIT CARD START -->
                         @include('funds.includes.creditCard') 
                      </div>
                      <div class="tab-pane" id="paypal">
                          @include('funds.includes.paypal') 
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