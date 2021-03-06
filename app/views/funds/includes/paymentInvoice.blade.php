                <div class="row">
                  <div class="col-md-12 shadowed" id="Printable">
                    <div class="col-md-12"><br class="hidden-print">
    <div class="row">
        <div class="col-xs-12">
            <div class="text-center">
                <div class="alert alert-success hidden-print" role="alert" align="center"><b> This transaction has been completed!</b></div>
                
                <div class="invoice-header panel col-lg-12">
                    <div class="col-md-3">
                        <span class="navbar-brand logo"></span>
                        <span class="navbar-brand logo-text invoice-header-left">
                        <font size="5" color="white"><b>DigiSells</b></font></span>
                    </div>
                    <div class="col-md-6">
                        <h3 align="center">Funds Deposit Invoice</h3>
                    </div>
                    <div class="col-md-3">
                        <div  class="hidden-print">
                            <button  type="button" id="print" class="btn btn-info btn-lg" style="margin-top:10px;" ><span class="glyphicon glyphicon-print"></span> PRINT</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                @if($payment->payer->payment_method == 'paypal')
                     @include('funds.includes.showPaypalPayment')
                @elseif($payment->payer->payment_method == 'credit_card')
                     @include('funds.includes.showCreditCardPayment')
                @endif
            
         <div class="col-xs-12 col-md-3 col-lg-3 pull-right invoice-panel">
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
                    <h4 class="text-center"><strong>Order summary</strong></h4>
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
                        <div class="alert alert-info hidden-print" role="alert" align="center"><b>Well done!</b> Thank you for purchasing Digisells fund.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
                    </div>
                  </div>
                </div>