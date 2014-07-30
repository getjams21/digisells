@extends('layouts.master')
<?php $a='hello';?>
@section('header')
	@include('includes.navbar')
@stop
@section('content')
<div clas="row" style="padding-top:80px;">
	<div class="col-md-6 col-md-offset-3">
		<div class="panel panel-primary">
			<div class="panel-heading">
	   			 <h3 class="panel-title" ><h4 style="margin-left:20px;"><b >Registration</b></h4></h3>
	  		</div>
	  	<div class="panel-body">
			{{ Form::open(['route'=>'users.store']) }}	
			<div class="col-md-10 col-md-offset-1 " id="registrationForm" >
				<h4><b><i>Personal Information</i></b></h4>
				<hr>
					<div class="form-group">
						{{Form::label('firstName', 'First Name')}}
						{{Form::text('firstName',null,['class'=>'form-control','required'=>'required'])}}
					</div>
					<div class="form-group">
						{{Form::label('lastName', 'Last Name')}}
						{{Form::text('lastName',null,['class'=>'form-control','required'=>'required'])}}
					</div>
					<div class="form-group">
						{{Form::label('address', 'Address')}}
						{{Form::textarea('address',null,['class'=>'form-control','required'=>'required'])}}
					</div>
				<br>
					<h4><b><i>Account Information</i></b></h4>
				<hr>
					<div class="form-group">
						{{Form::label('email', 'Email')}}
						{{Form::email('email',null,['class'=>'form-control','required'=>'required'])}}
					</div>
					<div class="form-group">
						{{Form::label('password', 'Password')}}
						{{Form::password('password',['class'=>'form-control','required'=>'required'])}}
					</div>
					<div class="form-group">
						{{Form::label('passwordConfirmation','Retype Password')}}
						{{Form::password('passwordConfirmation',['class'=>'form-control','required'=>'required'])}}
					</div>
					<div style=":30%;margin-left:60%;" >
						{{ Form::Submit('Create Account',['class'=>'btn btn-primary']) }}
					</div>	
			</div>
			{{ Form::close()}}			
		</div>
		</div>
	</div>
</div>
@stop