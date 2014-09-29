@extends('layouts.master')

@section('header')
	@include('includes.navbar')
@stop
@section('content')
	@include('includes.auction.auction-result')
@stop