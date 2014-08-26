@extends('layouts.master')
@section('meta-title','Direct')
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
              <h4 class="capital"><b><a href="/users/{{Auth::user()->username}}">{{ Auth::user()->username }}'s</a> Direct Selling List</h4></b><br>
               <div class="col-md-12">
                <br><hr class="style-fade">
              <div class="table-responsive" style="border-top: 1px solid #C0C0C0;">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>Sale Name</th>
                      <th>Qty</th>
                      <th>Amount</th>
                      <th>Date Created</th>
                      <th>End Date</th>
                      <th>Qty Sold</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($selling as $selling)
                        <tr>
                          <td>{{$selling->sellingName}}</td>
                          <td>{{$selling->quantity}}</td>
                          <td>{{$selling->price}}</td>
                          <td>{{date("d F Y",strtotime($selling->created_at)) }} at {{ date("g:ha",strtotime($selling->created_at)) }}</td>
                          <td>{{date("d F Y",strtotime($selling->expirationDate)) }} at {{ date("g:ha",strtotime($selling->expirationDate)) }}</td>
                          <td>0</td>
                          <td>
                            @if($selling->sold==0)
                             <p style="color:green;"><b>AVAILABLE</b></p>
                            @else
                              <p style="color:red;"><b>ENDED</b></p>
                            @endif
                          </td>
                       </tr> 
                      @endforeach
                    <tr>
                      <td colspan="8"></td>
                    </tr>
                  </tbody>
                </table>
             </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
</div>  
@stop