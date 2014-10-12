<div class="col-md-12">
	 @if (Session::has('flash_message'))
      <div class="form-group ">
        <p>{{Session::get('flash_message') }}</p>
      </div>
    @endif
    <div class="col-md-4 col-md-offset-1"><br>
    <h4>Paypal Deposit Amount</h4><hr>
{{ Form::open(['action' => 'PaymentController@paypal']) }}
	<div class="form-group">
	{{Form::label('amount', 'Amount (USD)')}}
	{{Form::text('amount',null,['class'=>'form-control square','required'=>'required'])}}
	<p>{{ errors_for('amount', $errors)}}</p> 
	</div>
	<div class="form-group" style="margin-left:50%;" >
	  {{ Form::Submit('Add Funds',['class'=>'btn btn-primary square']) }}
	</div> 
{{ Form::close() }}
</div>
</div>