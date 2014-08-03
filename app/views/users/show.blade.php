@extends('layouts.master')
@section('header')
	@include('includes.navbar')
@stop
@section('content')
	<div clas="row" style="padding-top:30px;">
		<div class="col-md-6 col-md-offset-3">
			
		
			<h1><b>Hi {{$user->username}}
				<small>{{$user->address}}</small></b></h1>
			<br>
			<h3> {{$user->firstName}} {{$user->lastName}}</h3>

		@if($user->isCurrent())
			<b>{{ link_to_route('users.edit','Update your Profile', $user->username) }}</b>
		@endif
		</div>
	</div>	
@stop