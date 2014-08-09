<div class="row shadowed" id="Profile" >
	<div class="col-md-3">
		@if($user->userImage)
		{{ HTML::image(user_photos_display($user), 'profile photo', array('class' => 'thumb')) }}
		@else
		{{ HTML::image('images/users/default.png', 'profile photo', array('class' => 'thumb')) }}
		@endif
		<br><br>
		@if($user->isCurrent())
		<b style="margin-left:15px;">{{ link_to_route('users.edit','Update your Profile', $user->username) }}</b>
		@endif
	</div>
	<div class="col-md-6">
		@if($user->firstName)
			<h3><b>{{$user->firstName." ".$user->lastName}}<br>
			<small>{{$user->address}}</small></b></h3>
		@else
			<h3><b>{{$user->username}}</b></h3>
		@endif
		<h4><small><b>No feedback received yet</b></small></h4>
		<h4><small><b>No transactions successfully completed</b></small></h4>
		<br>
		<div>Active: 1 hour ago  &nbsp;&nbsp;|&nbsp;&nbsp; Member since: 2 days ago</div>
	</div>
	<div class="col-md-3">
		<br><br><br><button type="button" class="btn btn-warning btn-lg pull-left"><span class="glyphicon glyphicon-star-empty"></span>Watch Seller</button>
	</div>
</div>