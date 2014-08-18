<div class="col-md-12">
  @if (Session::has('flash_message'))
    <div class="form-group ">
      <p>{{Session::get('flash_message') }}</p>
    </div>
  @endif
{{ Form::open(['route'=>'payment.store']) }}
   <div class="col-md-4 col-md-offset-1"><br>
    <h4>Credit Card Credentials</h4><hr>
      <div class="form-group">
          {{Form::label('firstName', 'First Name')}}
          {{Form::text('firstName',null,['class'=>'form-control square','required'=>'required'])}}
          <p>{{ errors_for('firstName', $errors)}}</p> 
      </div>
      <div class="form-group">
          {{Form::label('lastName', 'Last Name')}}
          {{Form::text('lastName',null,['class'=>'form-control square','required'=>'required'])}}
          <p>{{ errors_for('lastName', $errors)}}</p> 
      </div>
      <div class="form-group">
          {{Form::label('cardNumber', 'Card Number')}}
          {{Form::text('cardNumber',null,['class'=>'form-control square','required'=>'required'])}}
          <p>{{ errors_for('cardNumber', $errors)}}</p> 
      </div>
      <div class="form-group">
          {{Form::label('cardType', 'Card Type')}}
          {{ Form::select('cardType', array('visa' => 'Visa', 'discover' => 'Discover','mastercard' => 'MasterCard','amercian express' => 'American Express',),'visa', ['class' => 'form-control square']) }}
          <p>{{ errors_for('cardType', $errors)}}</p> 
      </div><br>
    </div><div class="col-md-4 col-md-offset-1">
      <br><h4>Expiration Date</h4><hr>
      <div class="form-group">
          {{Form::label('month', 'Month')}}
          {{ Form::selectMonth('month',null, ['class' => 'form-control square']) }}
          <p>{{ errors_for('month', $errors)}}</p> 
      </div>
      <div class="form-group">
          {{Form::label('year', 'Year')}}
          {{ Form::selectYear('year',2014,2020,null, ['class' => 'form-control square']) }}
          <p>{{ errors_for('year', $errors)}}</p> 
      </div>
      <div class="form-group">
          {{Form::label('cvv2', 'CVV2 Number')}}
          {{Form::text('cvv2',null,['class'=>'form-control square','required'=>'required'])}}
          <p>{{ errors_for('cvv2', $errors)}}</p> 
      </div>
      <div class="form-group">
          {{Form::label('amount', 'Amount (USD)')}}
          {{Form::text('amount',null,['class'=>'form-control square','required'=>'required'])}}
          <p>{{ errors_for('cvv2', $errors)}}</p> 
      </div>
      
      <div class="form-group" style="margin-left:50%;" >
          {{ Form::Submit('Add Funds',['class'=>'btn btn-primary square']) }}
      </div> 
    <br>
  </div> 
{{ Form::close() }}
</div>