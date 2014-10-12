@extends('admin.master.layout')
@section('meta-title','Active_Accounts')
@section('content')
    <div class="row">
        <div class="col-lg-12"><br>
        	<div class="panel panel-primary">
        		<div class="panel-heading">
        			Update Profile of {{$user->username}}
        		</div>
        		<div class="panel-body">
             	@include('users.includes.editProfile') 
             	</div>
             </div>
        </div>
    </div>
@stop
@section('script')
{{ HTML::script('_/js/myscript.js')}}
@stop