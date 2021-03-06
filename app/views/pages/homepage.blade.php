@extends('layouts.master')
@section('meta-title','Home')
@section('metatags')

@stop
<!-- navbar -->
@section('header')
	@include('includes.navbar')
@stop
@section('inbodyscripts')

@stop
<!-- carousel -->
@section('carousel')
	@include('includes.homepage.carousel')
@stop
<!-- featured lists -->
@section('featured')
	@include('includes.homepage.featured-list')
@stop
<!-- panels -->
@section('content')
	@include('includes.homepage.content')
@stop
<!-- footer -->
@section('footer')
	@include('includes.footer')
@stop