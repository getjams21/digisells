@extends('layouts.master')
@section('meta-title','Support')
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
                    <br>
                    <div class="well">
                     
                  <div class="row">
                    <div class="col-md-12">
                      <div class="col-md-6">
                        <div class="panel panel-primary">
                          <div class="panel-heading">
                            <h4>New Request 
                            </h4>
                          </div>
                          <div class="panel-body">
                            @if (Session::has('flash_message'))
                              <div class="form-group">
                                <p>{{Session::get('flash_message') }}</p>
                              </div>
                            @endif
                            {{ Form::open(['route'=>'support.store',null,'files' => true]) }}
                              <div class="form-group">
                               <div class="input-group">
                                 <div class="input-group-addon">Please classify your ticket *</div>
                               <select class="form-control" name="category">
                                <option value="Account Issues">Account Issues</option>
                                <option value="Request Category">Request Category</option>
                                <option value="Payment Issues">Payment Issues</option>
                                <option value="Suggestions">Suggestions</option>
                                <option value="Complaints">Complaints</option>
                                <option value="Others">Others</option>
                              </select>
                               </div>
                            </div>
                            <div class="form-group">
                               <div class="input-group">
                                 <div class="input-group-addon">Priority Level *</div>
                               <select class="form-control" name="priority">
                                <option value="Urgent">Urgent</option>
                                <option value="High">High</option>
                                <option value="Medium" selected>Medium</option>
                                <option value="Low">Low</option>>
                              </select>
                               </div>
                            </div>

                              <div class="form-group input-group">
                                  <span class="input-group-addon">Subect * : </span>
                                  <input type="text" name="title" class="form-control" placeholder="Request Subject"  required>
                              </div>
                              <div class="form-group">
                             <div class="form-group">
                                {{Form::label('description', 'Request Details * ')}}
                                {{Form::textarea('description',null,['class'=>'form-control square','required'=>'required'])}}
                              </div>

                                <label>Add a Screenshot (Optional)</label><br>
                              <div class="input-group">
                                <span class="input-group-btn">
                                    <span class="btn btn-primary btn-file square">
                                        Browse&hellip; <input name="screenshot" type="file" id="screenshot">
                                    </span>
                                </span>
                                <input type="text" class="form-control" placeholder="Add Screenshot" readonly>
                            </div>
                            {{ errors_for('screenshot', $errors)}}<br>
                              <div class="form-group"  >
                                {{ Form::Submit('Submit',['class'=>'btn btn-primary  pull-right']) }}
                              </div>
                          </div>
                            {{ Form::close() }}
                        </div>
                      </div>
                      </div>
                      <div class="col-md-6">
                        <div class="well">
                        <h4><b> Submit a request for assistance </b></h4><br>

                        Fields marked with an asterisk (*) are mandatory. <br>

                        You'll be notified when our staff answers your request.

                        </div>    

                      </div>
                      </div>
                 </div>
                </div>
            </div><!--well-->
        </div>
        <!-- /#page-content-wrapper -->
    </div>
  </div>  
@stop
