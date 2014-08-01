@extends('layouts.master')
<!-- navbar -->
@section('header')
	@include('includes.navbar')
@stop
@section('content')
	@include('includes.selling.auction')
@stop