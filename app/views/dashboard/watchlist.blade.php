@extends('layouts.master')
@section('meta-title','Watching')
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
              <div class=""><br>
                   <h4 class="capital"><b>Listings you're watching</h4></b><br>
                   <div class="table-responsive" style="border-top: 1px solid #C0C0C0;">
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th>Watching</th>
                            <th>Date</th>
                            <th>Status</th>
                          </tr>
                         </thead> 
                         <tbody>
                             @foreach($watchlists as $watchlist)
                              <tr>
                                <td>You're currently watching 
                                  <a href="/users/{{$watchlist->username}}"><b>{{$watchlist->username}}</b></a>'s 
                                    @if($watchlist->productID)
                                      {{$watchlist->productName}}
                                    @else
                                     listings.
                                    @endif
                                  </td>
                                <td>{{dateformat($watchlist->created_at)}} at {{timeformat($watchlist->created_at)}}</td>
                                <td>@if($watchlist->status == 1)
                                        ACTIVE
                                    @endif
                                </td>
                             </tr> 
                            @endforeach
                          {{$watchlists->links()}}
                          </tbody>
                      </table>
                    </div>
                    <!-- <b><h4>You're not watching any Listings yet.</h4> </b> 
                    <b><h3><small>Watching a listing is the best way to stay up to date with the progress of multiple auctions and make sure you don't miss that perfect deal!</small> </h3></b>  -->
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
</div>  
@stop