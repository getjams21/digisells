@extends('layouts.master')
@section('meta-title','Watchers')
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
                   <h4 class="capital"><b><a href="/users/{{Auth::user()->username}}">{{ Auth::user()->username }}'s</a> Watchers</h4></b><br>
                   <div class="table-responsive" style="border-top: 1px solid #C0C0C0;">
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th>Watcher</th>
                            <th>Date</th>
                            <th>Status</th>
                          </tr>
                         </thead> 
                         <tbody>
                             @foreach($watchers as $watcher)
                              <tr>
                                 <td>
                                  <a href="/users/{{$watcher->username}}"><b>{{$watcher->username}}</b></a> hase been watching your  
                                    @if($watcher->productID)
                                      {{$watcher->productName}} listing.
                                    @else
                                     listings.
                                    @endif
                                  </td>
                                <td>{{dateformat($watcher->created_at)}} at {{timeformat($watcher->created_at)}}</td>
                                <td>@if($watcher->status == 1)
                                        ACTIVE
                                    @endif
                                </td>
                             </tr> 
                            @endforeach
                          {{$watchers->links()}}
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