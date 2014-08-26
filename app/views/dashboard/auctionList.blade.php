@extends('layouts.master')
@section('meta-title','Auction')
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
                    <h4 class="capital"><b><a href="/users/{{Auth::user()->username}}">{{ Auth::user()->username }}'s</a> Auction List</h4></b><br>
                  <div class="col-md-12">
                  <br><hr class="style-fade">
                <div class="table-responsive" style="border-top: 1px solid #C0C0C0;">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>Auction Name</th>
                        <th>Qty</th>
                        <th>Amount</th>
                        <th>Bids</th>
                        <th>Last Bidder</th>
                        <th>Date</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Status</th>
                      </tr>
                     </thead> 
                     <tbody>
                      <tr>
                        @foreach($auction as $auction)
                          <tr>
                            <td>{{$auction->auctionName}}</td>
                            <td>{{$auction->quantity}}</td>
                            <td>{{$auction->minimumPrice}}</td>
                            <td>0</td>
                            <td>None</td>
                            <td>-</td>
                            <td>{{date("d F Y",strtotime($auction->startDate)) }} at {{ date("g:ha",strtotime($auction->startDate)) }}</td>
                            <td>{{date("d F Y",strtotime($auction->endDate)) }} at {{ date("g:ha",strtotime($auction->endDate)) }}</td>
                            <td>
                              @if($auction->sold==0)
                               <p style="color:green;"><b>AVAILABLE</b></p>
                              @else
                                <p style="color:red;"><b>ENDED</b></p>
                              @endif
                            </td>
                         </tr> 
                        @endforeach
                      </tr>
                      <tr>
                        <td colspan="10"></td>
                      </tr>
                    </tbody>
                  </table>
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