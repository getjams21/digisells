@extends('layouts.master')
@section('meta-title','Login') 
@section('header')
	@include('includes.navbar')
@stop
@section('content')
<div clas="row " id="login" style="padding-top:30px;">
	<div class="col-md-10 col-md-offset-1 ">
		<div class="panel panel-success square shadowed">
			
	  	<div class="panel-body">
		{{ Form::open(['route'=>'sessions.store']) }}	
		<div class="col-md-12 "  id="siginForm" >
				
					<h3 align="center" >Log in to your account</h3>
				<br><hr class="style-fade" >	<br>
			<div class="col-md-6 col-md-offset-3 " id="siginForm" >
					@if (Session::has('flash_message'))
						<div class="form-group ">
							<p>{{Session::get('flash_message') }}</p>
						</div>
					@endif
					<div class="form-group">
						{{Form::label('username', 'Username')}}
						{{Form::text('username',null,['class'=>'form-control square'])}}
						{{ errors_for('username', $errors)}}
					</div>
					<div class="form-group">
						{{Form::label('password', 'Password')}}
						{{Form::password('password',['class'=>'form-control square'])}}
						{{ errors_for('password', $errors)}}
					</div>
					<div class="form-group" >
						<a href="#">Forgot your Password?</a>
					</div>
					<div class="form-group" style="width:30%;margin-left:65%;" >
							{{ Form::Submit('Sign in',['class'=>'btn btn-primary square','style'=>'width:100%;']) }}
					</div>	
					<div class="alert alert-warning square" role="alert" >
						<p  style="margin-left:10%;"><b>Registration is free</b> so to get full access : <a href="/register"><b>Sign up now!</b></a></p>
					</div>
			</div>		
		</div>
		{{ Form::close()}}			
		</div>
		</div>
	</div>
</div>

@stop
