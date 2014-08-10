<div class="col-md-12 showContent">
	<div class="col-md-5 showContent">
		@if (Session::has('flash_message'))
			<div class="form-group ">
				<p>{{Session::get('flash_message') }}</p>
			</div>
		@endif
		{{ Form::model($user, ['method'=>'PATCH','action' => ['UsersController@updateAccount', $user->username]])}}
		<br>	
		<h4 align="center" ><b><i>Account Information</i></b></h4>
		<hr class="style-fade"><br>
		<div class="form-group">
			{{Form::label('username', 'Username')}}
			{{Form::text('username',null,['class'=>'form-control square','disabled'=>true])}}
			{{ errors_for('username', $errors)}}
		</div>
		<div class="form-group">
			{{Form::label('email', 'Email Address')}}
			{{Form::email('email',null,['class'=>'form-control square','disabled'=>true])}}
			{{ errors_for('email', $errors)}}
		</div>
	</div><div class="col-md-7 ">
		<br>
		<h4 align="center" ><b><i>Change your Password</i></b></h4>
		<hr class="style-fade"><br>
		<div class="form-group">
			{{Form::label('old_password', 'Old Password')}}
			{{Form::password('old_password',['class'=>'form-control square'])}}
		<p>{{ errors_for('old_password', $errors)}}</p>
		<span id="passwordMessage" class="passwordMessage"></span>	
		</div>
		<div class="form-group">
			{{Form::label('password', 'New Password')}}
			{{Form::password('password',['class'=>'form-control square'])}}
			<p>{{ errors_for('password', $errors)}}</p> 
			<span id="confirmMessage" class="confirmMessage"></span>

		</div>
		<div class="form-group">
			{{Form::label('password_confirmation', 'Confirm New Password')}}
			{{Form::password('password_confirmation',['class'=>'form-control square'])}}
			{{ errors_for('password_confirmation', $errors)}}
			<span id="confirmMessage2" class="confirmMessage"></span>
		</div>

		<div class="form-group" style="width:30%;margin-left:65%;" >
				{{ Form::Submit('Update Password',['class'=>'btn btn-primary square','style'=>'width:100%;']) }}
		</div>	
		
		{{ Form::close() }}
	</div>

</div>