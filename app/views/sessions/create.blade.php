@extends('layouts.master')
@section('meta-title','Login')
@section('header')
	@include('includes.navbar')
@stop
@section('content')
<div clas="row" style="padding-top:80px;">
	<div class="col-md-6 col-md-offset-3">
		<div class="panel panel-primary">
			<div class="panel-heading">
	   			 <h3 class="panel-title" ><h4 style="margin-left:20px;"><b >Sign In</b></h4></h3>
	  		</div>
	  	<div class="panel-body">
			{{ Form::open(['route'=>'sessions.store']) }}	
			<div class="col-md-10 col-md-offset-1 " id="siginForm" >
				
					<h4><b><i>Account Information</i></b></h4>
				<hr>
					<div class="form-group">
						{{Form::label('email', 'Email')}}
						{{Form::text('email',null,['class'=>'form-control'])}}
						{{ errors_for('email', $errors)}}
					</div>
					<div class="form-group">
						{{Form::label('password', 'Password')}}
						{{Form::password('password',['class'=>'form-control'])}}
						{{ errors_for('password', $errors)}}
					</div>
					<div class="form-group" style=":30%;margin-left:60%;" >
						{{ Form::Submit('Sign in',['class'=>'btn btn-primary']) }}
					</div>	
					@if (Session::has('flash_message'))
						<div class="form-group">
							<p>{{Session::get('flash_message') }}</p>
						</div>
					@endif
				
			</div>
			{{ Form::close()}}			
		</div>
		</div>
	</div>
</div>
@stop