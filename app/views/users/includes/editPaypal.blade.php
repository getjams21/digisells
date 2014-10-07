<div class="col-md-12 showContent">
	@if (Session::has('flash_message'))
	      <div class="form-group ">
	        <p>{{Session::get('flash_message') }}</p>
	      </div>
	    @endif
	<div class="col-md-4 col-md-offset-1"><br>
	    @if(Auth::user()->paypal)
	    <div class="alert alert-success">
	        <b>Current Paypal Email: </b> <i>{{Auth::user()->paypal}}</i>
	    </div>
	    @else
	    <div class="alert alert-warning">
	        You Need to set your Paypal Email.<br>
	        Before you can add/affiliate any products.
	    </div>
	    @endif
	{{ Form::model($user, ['method'=>'PATCH','action' => ['UsersController@updatePaypal', $user->username]])}}
	    <div class="form-group">
	    {{Form::label('paypalemail', 'Paypal Email')}}
	    {{Form::email('email',null,['class'=>'form-control square','required'=>'required','id'=>'paypalemail'])}}
	    <p>{{ errors_for('paypalemail', $errors)}}</p> 
	    <span id="paypalerror" class="paypalerror"></span>
	    <div class="form-group">
	      {{Form::label('firstName', 'Paypal First Name')}}
	      {{Form::text('firstName',null,['class'=>'form-control square','required'=>'required'])}}
	    </div>
	    <div class="form-group">
	      {{Form::label('lastName', 'Paypal Last Name')}}
	      {{Form::text('lastName',null,['class'=>'form-control square','required'=>'required'])}}
	    </div>
	    </div>
	    @if(Auth::user()->type)
	      <div class="alert alert-warning">
	        If your Digisell password is not set.<br>
	        Set your password on account section 
	      </div>
	    @else <hr>
	    @endif
	    <div class="form-group">
	    {{Form::label('password', 'Digisells Account Password')}}
	    {{Form::password('password',['class'=>'form-control square','required'=>'required','id'=> 'password'])}}
	    <p>{{ errors_for('password', $errors)}}</p> 
	    
	    </div>
	    <div class="form-group" style="margin-left:50%;" >
	      {{ Form::Submit('Update',['class'=>'btn btn-primary square']) }}
	    </div> 
	{{ Form::close() }}
	</div>

</div>