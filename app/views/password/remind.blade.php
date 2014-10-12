@extends('layouts.master')
@section('meta-title','Password-Reset') 
@section('header')
	@include('includes.navbar')
@stop
@section('content')
<div clas="row " id="login" style="padding-top:30px;">
	<div class="col-md-10 col-md-offset-1 ">
		<div class="panel panel-success square shadowed">
			
	  	<div class="panel-body">
		{{ Form::open() }}	
		<div class="col-md-12 "  id="siginForm" >
				
					<h3 align="center" >Reset your password</h3>
				<br><hr class="style-fade" >	<br>
			<div class="col-md-6 col-md-offset-3 "  >
					
					<div class="form-group">
						{{Form::label('email', 'Email Address')}}
						{{Form::email('email',null,['class'=>'form-control square','required'=>'required'])}}
						{{ errors_for('email', $errors)}}
					</div>
					
					<div class="form-group" style="width:30%;margin-left:65%;" >
							{{ Form::Submit('Reset Password',['class'=>'btn btn-primary square','style'=>'width:100%;']) }}
					</div>
					@if (Session::has('error'))
						<div class="form-group alert alert-danger square">
							<p><center><b>{{Session::get('error') }}</b></center></p>
						</div>
					@elseif	(Session::has('status'))
						<div class="form-group alert alert-success square">
							<p><center><b>{{Session::get('status') }}</b></center></p>
						</div>
					@endif
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
