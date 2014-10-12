@extends('layouts.master')
@section('meta-title','Invoices')
@section('header')
	@include('includes.navbar')
@stop
@section('content')
<div class="panel panel-edit square" 
<?php
  if(!Session::has('flash_message')){
    echo "hidden";
  }
?>>
  <div class="container">
    <center>
      @if (Session::has('flash_message'))
        <div class="form-group ">
          <p>{{Session::get('flash_message') }}</p>
        </div>
      @endif
    </center>
  </div>
</div>
<div clas="row" >
  <div id="wrapper">
    @include('dashboard.includes.dashboardNavbar')
      <div id="page-content-wrapper">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12 shadowed">
              <div class=""><br>
                  <h4 class="capital"><b><a href="/users/{{Auth::user()->username}}">{{ Auth::user()->firstName }}'s</a> Invoices</h4></b><br>
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
                              <th>Feedback</th>
                              <th>Status</th>
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
                                  <td>
                                      @if($invoice->payKey)
                                   <a href="/product/items/{{$invoice->downloadLink}}"><button class="btn btn-primary btn-xs" ><i class="fa fa-download"></i>Download</button></a>
                                   @else
                                   Pay First
                                   @endif

                                 </td>
                                  <td> 
                                    {{ Form::open(['route'=>'product-review.create']) }}
                                      <button type="submit" name="productID" class="btn btn-warning btn-xs" value="{{$invoice->productID}}"
                                        ><i class="glyphicon glyphicon-star"></i>Give Feedback</button>
                                    {{ Form::close() }}
                                  </td>
                                  <td>@if($invoice->payKey)
                                      Paid
                                      @else
                                     <a href="/payBid/{{$invoice->id}}"><button class="btn btn-primary btn-xs" ><i class="fa fa-download"></i>Pay Here</button></a>
                                      @endif
                                  </td>
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
                              <th>Feedback</th>
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
                                  <td> 
                                    <form method="GET" action="http://digisells.com/product-review/create" accept-charset="UTF-8">
                                      <button type="submit" name="productID" class="btn btn-warning btn-xs" value="{{$invoice->productID}}"
                                        <?php 
                                          if($invoice->reviewID != NULL){
                                            echo 'disabled';
                                          }
                                        ?>
                                        ><i class="glyphicon glyphicon-star"></i>Give Feedback</button>
                                    </form>
                                  </td>
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