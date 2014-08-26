@extends('layouts.master')
@section('meta-title','Deposits')
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
                    <div class="col-md-12"><br>
                        <div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="text-center">
                <i class="fa fa-search-plus pull-left icon"></i>
                <div class="alert alert-success" role="alert" align="center"><b> This transaction has been completed!</b></div>
                <h2>@if($payment->payer->payment_method == 'paypal')
                     Paypal 
                @elseif($payment->payer->payment_method == 'credit_card')
                     Credit Card 
                @endif
                Invoice for Purchasing Digisells Funds</h2>
            </div>
            <hr>
            <div class="row">
                @if($payment->payer->payment_method == 'paypal')
                     @include('funds.includes.showPaypalPayment')
                @elseif($payment->payer->payment_method == 'credit_card')
                     @include('funds.includes.showCreditCardPayment')
                @endif
            
        
         <div class="col-xs-12 col-md-3 col-lg-3 pull-right">
                    <div class="panel panel-primary height">
                        <div class="panel-heading">Recipient</div>
                        <div class="panel-body">
                            <strong>Admin Digisells <b style="color:green;">(VERIFIED)</b></strong><br>
                            admin@digisells.com<br>
                            1 Main St <br>
                            San Jose CA <br>
                            95131 US
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="text-center"><strong>Order summary</strong></h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <td><strong>Payment Description</strong></td>
                                    <td class="text-center"><strong>Amount</strong></td>
                                    <td class="text-center"><strong>Currency</strong></td>
                                    <td class="text-right"><strong>Total</strong></td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Deposit Digisells Funds :</td>
                                    <td class="text-center">{{$payment->transactions[0]->amount->total}}</td>
                                    <td class="text-center">{{$payment->transactions[0]->amount->currency}}</td>
                                    <td class="text-right">{{$payment->transactions[0]->amount->total}} {{$payment->transactions[0]->amount->currency}}</td>
                                </tr>
                                <hr>
                                <tr>
                                    <td ><i class="fa fa-barcode iconbig"></i></td>
                                    <td ></td>
                                    <td class=" text-center"><strong>TOTAL</strong></td>
                                    <td class=" text-right"><b>{{$payment->transactions[0]->amount->total}} {{$payment->transactions[0]->amount->currency}}</b></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="alert alert-info" role="alert" align="center"><b>Well done!</b> Thank you for purchasing Digisells fund.</div>
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
        <!-- /#page-content-wrapper -->
    </div>
  </div>  
@stop









<!--  -->


