@extends('layouts.master')
@section('header')
	@include('includes.navbar')
@stop
@section('content')
	<div clas="row" style="padding-top:80px;">
		<div class="col-md-6 col-md-offset-3">
			<h3>{{ Auth::check() ? "Hi, ". Auth::user()->firstName: "why dont you sign up?";}} Thank you for signing up!</h3>
		</div>
	</div>	
@stop