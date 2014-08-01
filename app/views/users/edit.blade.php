@extends('layouts.master')
@section('meta-title','Edit Profile')
@section('header')
	@include('includes.navbar')
@stop
@section('content')
<div clas="row" style="padding-top:30px;">
	<div class="col-md-6 col-md-offset-3">
		<div class="panel panel-primary square">
			<div class="panel-heading square">
	   			 <h3 class="panel-title" ><h4 style="margin-left:20px;"><b >Update your Profile</b></h4></h3>
	  		</div>
	  	<div class="panel-body">
			{{ Form::model($user, ['method'=>'PATCH','route' => ['users.update', $user->username]]) }}	
			<div class="col-md-10 col-md-offset-1 " id="registrationForm" >
				<h4><b><i>Personal Information</i></b></h4>
				<hr>
					@if (Session::has('flash_message'))
						<div class="form-group">
							<p>{{Session::get('flash_message') }}</p>
						</div>
					@endif
					<div class="form-group">
						{{Form::label('firstName', 'First Name')}}
						{{Form::text('firstName',null,['class'=>'form-control square','required'=>'required'])}}
						{{ errors_for('firstName', $errors)}}
					</div>
					<div class="form-group">
						{{Form::label('lastName', 'Last Name')}}
						{{Form::text('lastName',null,['class'=>'form-control square','required'=>'required'])}}
						{{ errors_for('lastName', $errors)}}
					</div>
					<div class="form-group">
						{{Form::label('address', 'Address')}}
						{{Form::textarea('address',null,['class'=>'form-control square','required'=>'required'])}}
						{{ errors_for('address', $errors)}}
					</div>
				<br>

					<div class="form-group" style=":30%;margin-left:60%;" >
						{{ Form::Submit('Update Profile',['class'=>'btn btn-primary']) }}
					</div>	
			</div>
			{{ Form::close()}}			
		</div>
		</div>
	</div>
</div>
@stop