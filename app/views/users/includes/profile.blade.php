<div id="personalInformation">
	@if($user->userImage)
	{{ HTML::image('images/'.$user->username."/".$user->userImage, 'profile photo', array('class' => 'thumb','style'=>'width:150px;height:150px;')) }}
	@else
	{{ HTML::image('images/users/default.PNG', 'profile photo', array('class' => 'thumb','style'=>'width:150px;height:150px;')) }}
	@endif
	@if($user->firstName)
		<h2><b>{{$user->firstName." ".$user->lastName}}<br>
		<small>{{$user->address}}</small></b></h2>
	@else
		<h2><b>{{$user->username}}</b></h2>
	@endif
	<br>
	<h3> </h3>
	@if($user->isCurrent())
	<b>{{ link_to_route('users.edit','Update your Profile', $user->username) }}</b>
	@endif
</div>