	<div class="col-md-5 showContent">
		<br><center>
		@if (Session::has('flash_message'))
			<div class="form-group">
				<p>{{Session::get('flash_message') }}</p>
			</div>
		@endif
		<p>{{ errors_for('old_password', $errors)}}</p>
		<p>{{ errors_for('password', $errors)}}</p>
		<h4><b><i>Upload an Image</i></b></h4>
		<hr class="style-fade"><br>
		{{ Form::model($user, ['method'=>'PATCH','route' => ['users.update', $user->username],'files' => true,'id'=>'fileform']) }}
		@if($user->userImage)
		{{ HTML::image(user_photos_display($user), 'profile photo', array('class' => 'thumb','id'=>'default')) }}
		@else
		{{ HTML::image('images/users/default.png', 'profile photo', array('class' => 'thumb ','id'=>'default')) }}
		@endif

		</center>
		<br>
		{{ errors_for('userImage', $errors)}}
		<div class="alert alert-warning square" role="alert" >
				<p  style="margin-left:10%;"><b>Note: </b>Image size must be less than 2mb</p>
			</div>
		<div class="input-group">
		    <span class="input-group-btn">
		        <span class="btn btn-primary btn-file square">
		            Browse&hellip; <input name="userImage" type="file" id="userImage">
		        </span>
		    </span>
		    <input type="text" class="form-control" value="{{$user->userImage}}"readonly>
		</div>

		 </div>
			<!--PERSONAL INFORMATION  -->
		<div class="col-md-7 showContent" id="showContent" >
		<br><center>
			<h4><b><i>Personal Information</i></b></h4>
			</center><hr class="style-fade"><br>
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
		
		<div class="form-group" style=":34%;margin-left:60%;" >
			{{ Form::Submit('Update Profile',['class'=>'btn btn-primary square']) }}
		</div>
	</div>
	{{ Form::close()}}