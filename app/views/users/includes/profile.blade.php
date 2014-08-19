<div class="col-md-3">
		@if($user->userImage)
		{{ HTML::image(user_photos_display($user), 'profile photo', array('class' => 'thumb shadowed')) }}
		@else
		{{ HTML::image('images/users/default.png', 'profile photo', array('class' => 'thumb shadowed')) }}
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
		@if(Auth::user())
			@if(Auth::user()->id==$user->id)
			<hr><h5><b>You have <a href="/funds">
				@if(Config::get('currentfund'))
		        ${{Config::get('currentfund')}}
		        @else
		        $0.00
		        @endif </a> funds left.</b></h5>
		    @endif
		@endif
		<br>
		<div>Active: {{$activity}}  &nbsp;&nbsp;|&nbsp;&nbsp; Member since: {{$member}}</div>
	</div>
	<div class="col-md-3">
		<br><br><button type="button" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-star-empty"></span>Listing Profile</button>

		<br><button type="button" class="btn btn-warning btn-lg" style="margin-top:5px;"><span class="glyphicon glyphicon-star-empty"></span>Watch Seller</button>
	</div>