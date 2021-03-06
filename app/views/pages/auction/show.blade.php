@extends('layouts.master')

@section('styles')
	{{ HTML::style('packages/bootstrap-star-rating/css/star-rating.min.css') }}
@stop

@section('header')
	@include('includes.navbar')
@stop
@section('content')
	@include('includes.auction.show')
@stop
@section('script')
	{{ HTML::script('packages/bootstrap-star-rating/js/star-rating.min.js')}}
	{{ HTML::script('_/js/plugins/countdown-timer/jquery.countdown.js')}}
	{{ HTML::script('_/js/auction-listings.js')}}
@stop