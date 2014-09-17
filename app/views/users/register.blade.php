@extends('layouts.master')
@section('meta-title','Register')
@section('header')
	@include('includes.navbar')
@stop
@section('content')
<div clas="row" style="padding-top:30px;">
	<div class="col-md-10 col-md-offset-1">
		<div class="panel panel-success square shadowed">
	  	<div class="panel-body">
	  		<div class="row">
	  			<div class="col-md-10 panel-margin">
	  				<h3 style="color:#254117;"><i>Register for free and start buying and selling digital products.</i></h3>
	  			</div>
	  		</div><br>
	  		<hr class="style-fade">
	  		<br>
	  	<div class="col-md-4 panel-margin " id="registrationForm" >
			{{ Form::open(['route'=>'users.store']) }}	
			
					<h4 style="color:#151B54;">Account Information</h4><br>
					<div class="form-group">
						{{Form::label('username', 'Username')}}
						{{Form::text('username',null,['class'=>'form-control square','required'=>'required','id'=>'username'])}}
						<p>{{ errors_for('username', $errors)}}</p> 
						<span id="searchMessage" class="searchMessage"></span>
					</div>
					<div class="form-group">
						{{Form::label('email', 'Email')}}
						{{Form::text('email',null,['class'=>'form-control square','required'=>'required'])}}
					<p>{{ errors_for('email', $errors)}}</p> 
						<span id="searchEmail" class="searchEmail"></span>
					</div>
					<div class="form-group">
						{{Form::label('password', 'Password')}}
						{{Form::password('password',['class'=>'form-control square','required'=>'required','id'=> 'password'])}}
					 	<p>{{ errors_for('password', $errors)}}</p> 
						<span id="confirmMessage" class="confirmMessage"></span>
					</div>
					<div class="form-group">
						{{Form::label('password_confirmation','Confirm Password')}}
						{{Form::password('password_confirmation',['class'=>'form-control square','id'=>'password_confirmation','required'=>'required'])}}
						<span id="confirmMessage2" class="confirmMessage"></span>
					</div>

					<div class="form-group" style="margin-left:60%;" >
						{{ Form::Submit('Create Account',['class'=>'btn btn-primary square']) }}
					</div>	
			{{ Form::close()}}	
			</div>	
			<div class="col-md-6 col-md-offset-1 "  >
	  			<h3 style="color:#254117;">
	  				Join DigiSells so you can:
	  			</h3><br>
	  			<ul style="color:#306754;">
	  				<h4><li >Sell 10 Digital items for free.</li></h4>
	  				<h4><li>Bid or make offers on digital goods.</li></h4>
	  				<h4><li>Promote products and earn cash.</li></h4>
	  				<h4><li>Add items to your watchlist.</li></h4>
	  			</ul><br>
	  			<div class="col-md-7">
	  			<a href="/facebookLogin" class="btn btn-block btn-social btn-facebook">
                         <i class="fa fa-facebook"></i> Sign in with Facebook
                     </a>
                     <a class="btn btn-block btn-social btn-google-plus">
                          <i class="fa fa-google-plus"></i> Sign in with Google
                     </a>
                </div>
	  		</div>
				</div>
		</div>
	</div>
</div>
@stop
