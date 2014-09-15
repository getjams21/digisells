@extends('layouts.master')

@section('header')
	@include('includes.navbar')
@stop
@section('content')
	@include('includes.auction.auction-listings')
@stop
@section('scripts')
	{{ HTML::script('_/js/plugins/jquery-shorten/jquery.shorten.1.0.js')}}
	{{ HTML::script('_/js/plugins/countdown-timer/jquery.countdown.js')}}
@stop