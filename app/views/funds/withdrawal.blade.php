@extends('layouts.master')
@section('meta-title','Withdrawals')
@section('header')
    @include('includes.navbar')
@stop
@section('content')
<div clas="row" >
    <div id="wrapper">
    @include('dashboard.includes.dashboardNavbar')
     <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                  <div class="col-md-12 shadowed">
                    <div class="col-md-12"><hr>
                      <h4 class="capital" style="color:#254117;"><b><i>Enter amount for withdrawal</i></b></h4>
                      <hr>
                      
                     <div class="col-md-12">
                        @if (Session::has('flash_message'))
                          <div class="form-group ">
                            <p>{{Session::get('flash_message') }}</p>
                          </div>
                        @endif
                    <div class="col-md-4 col-md-offset-1"><br>
                    {{ Form::open(['action' => 'WithdrawalController@store']) }}
                        <div class="form-group">
                        {{Form::label('amount', 'Amount (USD)')}}
                        {{Form::text('amount',null,['class'=>'form-control square','required'=>'required'])}}
                        <p>{{ errors_for('amount', $errors)}}</p> 
                        </div>
                        <div class="form-group">
                        {{Form::label('paypalemail', 'Paypal Email')}}
                        {{Form::email('email',null,['class'=>'form-control square','required'=>'required','id'=>'paypalemail'])}}
                        <p>{{ errors_for('paypalemail', $errors)}}</p> 
                        <span id="paypalerror" class="paypalerror"></span>
                        <div class="form-group">
                          {{Form::label('firstName', 'Paypal First Name')}}
                          {{Form::text('firstName',null,['class'=>'form-control square','required'=>'required'])}}
                        </div>
                        <div class="form-group">
                          {{Form::label('lastName', 'Paypal Last Name')}}
                          {{Form::text('lastName',null,['class'=>'form-control square','required'=>'required'])}}
                        </div>
                        </div>
                        @if(Auth::user()->type)
                          <div class="alert alert-warning">
                            If your Digisell password is not set.<br>
                            Set your password on account section <a href="/users/{{Auth::user()->username}}/edit#editAccountInfo"><b>here.</b></a>
                          </div>
                        @else <hr>
                        @endif
                        <div class="form-group">
                        {{Form::label('password', 'Digisells Account Password')}}
                        {{Form::password('password',['class'=>'form-control square','required'=>'required','id'=> 'password'])}}
                        <p>{{ errors_for('password', $errors)}}</p> 
                        
                        </div>
                        <div class="form-group" style="margin-left:50%;" >
                          {{ Form::Submit('Withdraw',['class'=>'btn btn-primary square']) }}
                        </div> 
                    {{ Form::close() }}
                    </div>
                    </div>
                      
                      </div>
                      </div>
                  </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->
    </div>
  </div>  
@stop