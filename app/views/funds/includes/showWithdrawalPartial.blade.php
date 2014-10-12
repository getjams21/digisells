<div class="row">
                  <div class="col-md-12 shadowed" id="Printable">
                    <div class="col-md-12"><br class="hidden-print">
    <div class="row">
        <div class="col-xs-12">
            <div class="text-center">
                <div class="alert alert-success hidden-print" role="alert" align="center"><b> This transaction has been completed!</b></div>
                <div class="invoice-header panel col-xs-12">
                	<div class="col-md-3">
	                	<span class="navbar-brand logo"></span>
	                	<span class="navbar-brand logo-text invoice-header-left">
	                	<font size="5" color="white"><b>DigiSells</b></font></span>
                	</div>
                	<div class="col-md-6">
	                	<h3 align="center">Funds Withdrawal Receipt</h3>
                	</div>
                	<div class="col-md-3">
                		<div  class="">
                			<button  type="button" id="print" class="btn btn-info btn-lg hidden-print" style="margin-top:10px;" ><span class="glyphicon glyphicon-print"></span> PRINT</button>
                		</div>
                	</div>
                </div>
            </div>
            <div class="row">
               <div class="col-xs-12 col-md-3 col-lg-3 pull-left invoice-panel">
                    <div class="panel panel-primary height">
                        <div class="panel-heading">Recipient Details</div>
                        <div class="panel-body">
                            <b>Type:</b> Paypal<br>
                            <strong>{{$withdrawal->paymentInfoList->paymentInfo[0]->receiver->email}}</strong><br>
                            <b>Primary:</b> {{$withdrawal->paymentInfoList->paymentInfo[0]->receiver->primary}}<br>
                            <b>Status:</b> VERIFIED<br>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-3 col-lg-3 invoice-panel">
                    <div class="panel panel-primary height">
                        <div class="panel-heading">Payment Information</div>
                        <div class="panel-body">
                            <strong>Transaction ID:</strong> {{$withdrawal->paymentInfoList->paymentInfo[0]->transactionId}}<br>
                            <strong>Mode:</strong> {{$withdrawal->paymentInfoList->paymentInfo[0]->receiver->paymentType}}<br>
                            <strong>State:</strong> {{$withdrawal->paymentInfoList->paymentInfo[0]->transactionStatus}}<br>
                            <strong>Date: </strong> {{dateformat($date[0]->created_at)}} at {{timeformat($date[0]->created_at)}}<br>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-3 col-lg-3 invoice-panel">
                    <div class="panel panel-primary height">
                        <div class="panel-heading">Related Resources</div>
                        <div class="panel-body">
                            <strong>Sender Transaction ID:</strong> {{$withdrawal->paymentInfoList->paymentInfo[0]->senderTransactionId}}<br>
                            <strong>Sender Transaction Status:</strong> {{$withdrawal->paymentInfoList->paymentInfo[0]->senderTransactionStatus}}<br>
                        </div>
                    </div>
                </div>
         		<div class="col-xs-12 col-md-3 col-lg-3 pull-right invoice-panel">
                    <div class="panel panel-primary height">
                        <div class="panel-heading">Sender Details</div>
                        <div class="panel-body">
                            <strong>Digisells Admin <b style="color:green;">(VERIFIED)</b></strong><br>
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
                    <h4 class="text-center"><strong>Transaction Summary</strong></h4>
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
                                    <td>Withdraw Digisells Funds :</td>
                                    <td class="text-center">{{$withdrawal->paymentInfoList->paymentInfo[0]->receiver->amount}}</td>
                                    <td class="text-center">USD</td>
                                    <td class="text-right">{{$withdrawal->paymentInfoList->paymentInfo[0]->receiver->amount}}</td>
                                </tr><hr><tr>
                                    <td ><i class="fa fa-barcode iconbig"></i></td>
                                    <td ></td>
                                    <td class=" text-center"><strong>TOTAL</strong></td>
                                    <td class=" text-right"><b>{{$withdrawal->paymentInfoList->paymentInfo[0]->receiver->amount}} USD</b></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="alert alert-info hidden-print" role="alert" align="center"><b>Well done!</b> You have successfully withdrawn a Digisells fund.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

                    </div>
                  </div>
            </div>