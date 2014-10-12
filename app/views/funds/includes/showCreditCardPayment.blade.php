<div class="col-xs-12 col-md-3 col-lg-3 pull-left invoice-panel">
    <div class="panel panel-primary height">
        <div class="panel-heading">Payer Details</div>
        <div class="panel-body">
            <strong>{{$payment->payer->funding_instruments[0]->credit_card->first_name}} {{$payment->payer->funding_instruments[0]->credit_card->last_name}}</strong><br>
            <b>Type:</b> {{$payment->payer->payment_method}} <br>
            <b>Status:</b> {{$payment->state}} <br>
        </div>
    </div>
</div>
<div class="col-xs-12 col-md-3 col-lg-3 invoice-panel">
    <div class="panel panel-primary height">
        <div class="panel-heading">Payment Information</div>
        <div class="panel-body">
            <b>Method:</b> {{$payment->payer->payment_method}}<br>
            <strong>Date: </strong>
            {{dateformat($payment->create_time)}} at {{timeformat($payment->create_time)}}
            <br>
            <strong>Card Type: </strong>
            {{$payment->payer->funding_instruments[0]->credit_card->type}} 
            <br>
            <strong>Card No.: </strong>
            {{$payment->payer->funding_instruments[0]->credit_card->number}} 
            <br>
            <strong>Exp Date: </strong>
            {{$payment->payer->funding_instruments[0]->credit_card->expire_month}}/{{$payment->payer->funding_instruments[0]->credit_card->expire_year}} <br>
        </div>
    </div>
</div>
<div class="col-xs-12 col-md-3 col-lg-3 invoice-panel">
    <div class="panel panel-primary height">
        <div class="panel-heading">Related Resources</div>
        <div class="panel-body">
            <strong>Trans ID: </strong>
            {{$payment->transactions[0]->related_resources[0]->sale->id}} <br>
            <strong>Payment ID: </strong>
            <span class="wordwrap"> {{$payment->id}}</span><br>
        </div>
    </div>
</div>