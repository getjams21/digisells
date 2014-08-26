<div class="col-xs-12 col-md-3 col-lg-3 pull-left">
                    <div class="panel panel-primary height">
                        <div class="panel-heading">Payer Details</div>
                        <div class="panel-body">
                            <strong>{{$payment->payer->payer_info->first_name}} {{$payment->payer->payer_info->last_name}}</strong><br>
                            <b>Type:</b> {{$payment->payer->payment_method}}<br>
                            <b>Email:</b> {{$payment->payer->payer_info->email}}<br>
                            <b>Status:</b> {{$payment->payer->status}}<br>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-3 col-lg-3">
                    <div class="panel panel-primary height">
                        <div class="panel-heading">Payment Information</div>
                        <div class="panel-body">
                            <b>Method:</b> {{$payment->payer->payment_method}}<br>
                            <strong>Date: </strong> {{dateformat($payment->create_time)}} at {{timeformat($payment->create_time)}}<br>
                            <strong>Mode:</strong> {{$payment->transactions[0]->related_resources[0]->sale->payment_mode}}<br>
                            <strong>State:</strong> {{$payment->transactions[0]->related_resources[0]->sale->state}}<br>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-3 col-lg-3">
                    <div class="panel panel-primary height">
                        <div class="panel-heading">Related Resources</div>
                        <div class="panel-body">
                            <strong>Trans ID:</strong> {{$payment->transactions[0]->related_resources[0]->sale->id}}<br>
                            <strong>Protection:</strong> {{$payment->transactions[0]->related_resources[0]->sale->protection_eligibility}}<br>
                            <strong>Payment ID:</strong> {{$payment->id}}<br>
                        </div>
                    </div>
                </div>
               