@extends('layouts.master')
@section('header')
	@include('includes.navbar')
@stop
@section('content')
	<div clas="row" style="padding-top:30px;">
		<div class="col-md-6 col-md-offset-3">
			<!-- <h3>{{ Auth::check() ? "Hi, ". Auth::user()->firstName: "why dont you sign up?";}} Thank you for signing up!</h3> -->
		
		
			<h1><b>{{$user->username}}<small> {{$user->address}}</small></b></h1>
			<br>

		@if($user->isCurrent())
			<b>{{ link_to_route('users.edit','Update your Profile', $user->username) }}</b>
		@endif
		</div>
	</div>	
@stop