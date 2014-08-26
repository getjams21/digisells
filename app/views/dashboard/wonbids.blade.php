@extends('layouts.master')
@section('meta-title','Won')
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
                      <h4 class="capital"><b><a href="/users/{{Auth::user()->username}}">{{ Auth::user()->username }}'s</a> Bids Won</h4></b>
                      <hr >
                        <div class="col-md-12"><br>
                          <hr class="style-fade">    
                      <div class="table-responsive" style="border-top: 1px solid #C0C0C0;">
                          <table class="table table-hover">
                            <thead>
                              <tr>
                                <th>Bid ID</th>
                                <th>Amount</th>
                                <th>Time</th>
                                <th>Ending</th>
                              </tr>
                             </thead> 
                             <tbody>
                              <tr>
                                <td colspan="4"></td>
                              </tr>
                            </tbody>
                          </table>
                    </div>
                          <h3><small>You don't have any Active Bids just yet.</small></h3>
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