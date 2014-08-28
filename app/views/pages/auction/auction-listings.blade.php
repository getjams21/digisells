@extends('layouts.master')

@section('header')
	@include('includes.navbar')
@stop
@section('content')
	@include('includes.auction.auction-listings')
@stop
@section('scripts')
	{{ HTML::script('_/js/load-more.js')}}
@stop