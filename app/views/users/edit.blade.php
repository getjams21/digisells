@extends('layouts.master')
@section('meta-title','Edit Profile')
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
                    <div class="col-lg-12" id="showContent" >
                    	<div clas="col-md-6 col-md-offset-1">
                        	{{ Form::model($user, ['method'=>'PATCH','route' => ['users.update', $user->username],'files' => true,'id'=>'fileform']) }}<h4><b><i>Personal Information</i></b></h4>
						<hr>
							@if($user->userImage)
							{{ HTML::image('images/'.$user->username."/".$user->userImage, 'profile photo', array('class' => 'thumb','style'=>'width:150px;height:150px;','id'=>'default')) }}
							@else
							{{ HTML::image('images/users/default.PNG', 'profile photo', array('class' => 'thumb ','style'=>'width:150px;height:150px;','id'=>'default')) }}
							@endif
							@if (Session::has('flash_message'))
								<div class="form-group">
									<p>{{Session::get('flash_message') }}</p>
								</div>
							@endif
							<div class="form-group">
								{{Form::label('userImage', 'Your Image')}}
								{{Form::file('userImage',null,['class'=>' form-control square ','name'=>'file'])}}
							</div>

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
        </div>
        <!-- /#page-content-wrapper -->
		</div>
	</div>	
@stop