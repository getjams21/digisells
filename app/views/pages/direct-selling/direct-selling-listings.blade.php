@extends('layouts.master')

@section('header')
	@include('includes.navbar')
@stop
@section('content')
	@include('includes.direct-selling.direct-selling-listings')
@stop
@section('scripts')
	{{ HTML::script('_/js/plugins/jquery-shorten/jquery.shorten.1.0.js')}}
@stop