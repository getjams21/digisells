@extends('layouts.master')
<!-- file-upload-styles -->
<!-- navbar -->
@section('header')
	@include('includes.navbar')
@stop
@section('content')
	@include('includes.product.edit-details')
@stop
@section('script')
	{{ HTML::script('packages/ckeditor/ckeditor.js')}}
@stop