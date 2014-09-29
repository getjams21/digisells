@extends('layouts.master')

@section('styles')
	{{ HTML::style('packages/bootstrap-star-rating/css/star-rating.min.css') }}
@stop

@section('header')
	@include('includes.navbar')
@stop
@section('content')
	@include('includes.review.product-review')
@stop
@section('script')
	{{ HTML::script('packages/bootstrap-star-rating/js/star-rating.min.js')}}
@stop