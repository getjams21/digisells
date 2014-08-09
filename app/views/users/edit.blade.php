@extends('layouts.master')
@section('meta-title','Dashboard')
@section('header')
	@include('includes.navbar')
@stop
@section('content')
<div clas="row" >
		<div id="wrapper">
		@include('users.includes.dashboardNavbar')
		 <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4" id="showContent" >
                        	{{ Form::model($user, ['method'=>'PATCH','route' => ['users.update', $user->username],'files' => true,'id'=>'fileform']) }}
							<center>
                        	<h4><b><i>Personal Information</i></b></h4>
								<hr>
								<div class="alert alert-warning square" role="alert" >
									<p  style="margin-left:10%;"><b>Note: </b>Image size must be less than 2mb</p>
								</div>
							@if($user->userImage)
							{{ HTML::image(user_photos_display($user), 'profile photo', array('class' => 'thumb','id'=>'default')) }}
							@else
							{{ HTML::image('images/users/default.png', 'profile photo', array('class' => 'thumb ','id'=>'default')) }}
							@endif

							</center>
							<br>
							{{ errors_for('userImage', $errors)}}
							@if (Session::has('flash_message'))
								<div class="form-group">
									<p>{{Session::get('flash_message') }}</p>
								</div>
							@endif
							<div class="input-group">
							    <span class="input-group-btn">
							        <span class="btn btn-primary btn-file">
							            Browse&hellip; <input name="userImage" type="file" id="userImage">
							        </span>
							    </span>
							    <input type="text" class="form-control" value="{{$user->userImage}}"readonly>
							</div>
							<br><br>
							<div class="form-group">
								{{Form::label('firstName', 'First Name')}}
								{{Form::text('firstName',null,['class'=>'form-control square','required'=>'required'])}}
								{{ errors_for('firstName', $errors)}}
							</div>
							<div class="form-group">
								{{Form::label('lastName', 'Last Name')}}
								{{Form::text('lastName',null,['class'=>'form-control square','required'=>'required','id'=>'lastName'])}}
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
					{{ Form::close()}}
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->
		</div>
	</div>	
@stop