@extends('layouts.master')
@section('meta-title','Invoices')
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
                  <h4 class="capital"><b><a href="/users/{{Auth::user()->username}}">{{ Auth::user()->username }}'s</a> Invoices</h4></b><br>
                   <div class="col-md-6 table-responsive" style="border-top: 1px solid #C0C0C0;">
                   <h4>Auctions</h4>    
                      <table class="table table-hover">
                          <thead>
                            <tr>
                              <th>Invoice Number</th>
                              <th>Product Name</th>
                              <th>Amount</th>
                              <th>Date</th>
                            </tr>
                          </thead>
                          <tbody>
                            @if ($auctionInvoice)
                              @foreach ($auctionInvoice as $invoice)
                                <tr>
                                  <td>{{$invoice->transactionNO}}</td>
                                  <td>{{$invoice->productName}}</td>
                                  <td>{{round($invoice->amount,2)}}</td>
                                  <td>{{date('m-d-Y', strtotime($invoice->created_at))}}</td>
                                </tr>
                              @endforeach
                            @endif
                          </tbody>
                      </table>
                  </div>
                   <div class="col-md-6 table-responsive" style="border-top: 1px solid #C0C0C0;">    
                    <h4>Direct Selling</h4>
                      <table class="table table-hover">
                          <thead>
                            <tr>
                              <th>Invoice Number</th>
                              <th>Product Name</th>
                              <th>Amount</th>
                              <th>Date</th>
                            </tr>
                          </thead>
                          <tbody>
                            @if($sellingInvoice)
                              @foreach ($sellingInvoice as $invoice)
                                <tr>
                                  <td>{{$invoice->transactionNO}}</td>
                                  <td>{{$invoice->productName}}</td>
                                  <td>{{round($invoice->amount,2)}}</td>
                                  <td>{{date('m-d-Y', strtotime($invoice->created_at))}}</td>
                                </tr>
                              @endforeach
                            @endif
                            
                          </tbody>
                      </table>
                  </div>   
                    @if (Session::has('flash_message'))
                      <div class="form-group ">
                        <p>{{Session::get('flash_message') }}</p>
                      </div>
                    @endif
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
</div>  
@stop