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
                   <div class="col-md-6 " >
                   <div class="panel panel-primary">
                      <div class="panel-heading"><h4>Auction Invoices</h4></div>
                    <div class="panel-body"> 
                    <div class="table-responsive">
                      <table class="table table-striped table-bordered table-hover" id="auctionInvoice">
                          <thead>
                            <tr>
                              <th>Invoice Number</th>
                              <th>Product Name</th>
                              <th>Amount</th>
                              <th>Date</th>
                              <th>Download</th>
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
                                  <td> <a href="/product/items/{{$invoice->downloadLink}}"><button class="btn btn-primary btn-xs" ><i class="fa fa-download"></i>Download</button></a></td>
                                </tr>
                              @endforeach
                            @endif
                          </tbody>
                      </table>
                    </div>
                   </div>  
                  </div>
                  </div>
                   <div class="col-md-6" >  
                   <div class="panel panel-primary">
                      <div class="panel-heading"><h4>Direct Selling Invoices</h4></div>
                    <div class="panel-body">
                    <div class="table-responsive" >  
                      <table class="table table-striped table-bordered table-hover" id="sellingInvoice">
                          <thead>
                            <tr>
                              <th>Invoice Number</th>
                              <th>Product Name</th>
                              <th>Amount</th>
                              <th>Date</th>
                              <th>Download</th>
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
                                  <td><a href="/product/items/{{$invoice->downloadLink}}"><button class="btn btn-primary btn-xs" ><i class="fa fa-download"></i> Download</button></a></td>
                                </tr>
                              @endforeach
                            @endif
                            
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
      </div>
  </div>
</div>  
@stop
@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        $('#auctionInvoice').dataTable({
          "order": [[ 3, "desc" ]]
        });
         $('#sellingInvoice').dataTable({
          "order": [[ 3, "desc" ]]
        });
    });
</script>
@stop