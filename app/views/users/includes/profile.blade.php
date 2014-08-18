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
		<hr><h5><b>You have <a href="/funds">$
		@if(Config::get('currentfund'))
        {{Config::get('currentfund')}}</a> funds left.
        @else
        $0.00
        @endif </b></h5>
		<br>
		<div>Active: 1 hour ago  &nbsp;&nbsp;|&nbsp;&nbsp; Member since: 2 days ago</div>
	</div>
	<div class="col-md-3">
		<br><br><button type="button" class="btn btn-primary btn-lg pull-left"><span class="glyphicon glyphicon-star-empty"></span>Listing Profile</button>

		<br><br><button type="button" class="btn btn-warning btn-lg pull-left" style="margin-top:10px;"><span class="glyphicon glyphicon-star-empty"></span>Watch Seller</button>
	</div>