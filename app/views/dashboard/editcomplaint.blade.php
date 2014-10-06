@extends('layouts.master')
@section('meta-title','Support')
@section('header')
	@include('includes.navbar')
@stop
@section('content')
@include('includes.solveRequestModal')
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
                      @if (Session::has('flash_message'))
                          <div class="form-group ">
                            <p>{{Session::get('flash_message') }}</p>
                          </div>
                        @endif
                      <div class="col-md-6">
                        <div class="panel panel-primary">
                                <div class="panel-heading"> 
                                    <b>Request Details</b>
                                   <span class="pull-right"> <b >Urgency: </b> <i>{{$complaint[0]->priority}}</i></span>
                                </div>
                              <div class="panel-body">
                                  <div class="form-group input-group">
                                    <span class="input-group-addon">Title: </span>
                                    <input type="text"  class="form-control" value="{{$complaint[0]->title}}" disabled>
                                  </div> 
                                  <b>Category: </b> <i>{{$complaint[0]->category}}</i>
                                  <br><br>
                                  <hr class="style-fade">
                                  @if($complaint[0]->screenshot)
                                   <label>View Screenshot:</label><br>
                                   <div class="input-group">
                                    <span class="input-group-btn">
                                      <a href="/images/screenshots/{{$complaint[0]->screenshot}}" target="_blank">
                                        <span class="btn btn-primary btn-file square">
                                            View&hellip;
                                        </span></a>
                                    </span>
                                    <input type="text" class="form-control" value="{{$complaint[0]->screenshot}}" readonly>
                                  </div><br>
                                  @else
                                  <i>No screenshot provided </i><br>
                                  @endif
                                  @if($complaint[0]->solved==0)
                                  <hr class="style-fade">
                                  <div>
                                    <input class="btn btn-success " type="button" id="solveBtn" value="Click to Mark as Solved">
                                  </div> 
                                  @else
                                    <div class="alert alert-success">This request is <b>SOLVED</b></div>
                                  @endif 
                                </div>
                                </div>
                        <div class="panel panel-primary">
                          <div class="panel-heading">
                            <h5>Reply for Ticket No. {{$complaint[0]->ticket}}
                            </h5>
                          </div>
                        @if($complaint[0]->solved==0)
                          <div class="panel-body">
                            {{ Form::open(['method'=>'POST','url'=>['/addComplaint',$complaint[0]->ticket]]) }}
                              
                              <div class="form-group">
                             <div class="form-group">
                                {{Form::label('description', 'Reply')}}
                                {{Form::textarea('description',null,['class'=>'form-control square','required'=>'required'])}}
                              </div>
                              <div class="form-group"  >
                                {{ Form::Submit('Confirm',['class'=>'btn btn-primary  pull-right']) }}
                              </div>
                          </div>
                            {{ Form::close() }}
                        </div>
                      @else
                      <br>
                         <div class="well">
                          <div class="row">
                            <div class="col-md-2">
                             <i class="fa fa-check-circle fa-5x success"></i>
                            </div>
                            <div class="col-md-10">
                             <h4>You cannot reply to a solved request.</h4>
                            Please create a new request if you have other concerns.
                            </div> 
                          </div> 
                         </div>

                      @endif
                      </div>
                      </div>
                          <div class="col-md-6">
                              
                             <div class="well">
                              
                            <div class="panel panel-primary">
                              <div class="panel-heading">Request Conversation</div>
                                 @foreach($details as $complain)
                                    <div class="panel-body">
                                     <span class="pull-left"><b>SENDER:</b><i> {{$complain->firstName}}</i></span> 
                                      <span class="pull-right"><b>SENT:</b><i> {{$complain->created_at}}</i></span>
                                      <div class="form-group">
                                      <textarea disabled class="form-control" rows="3">
                                      {{$complain->description}}</textarea>
                                        </div>
                                    </div>
                              @endforeach
                                  </div>
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
@section('script')
<script type="text/javascript">
   $(document).ready(function() {
        $('#soldSelling').dataTable( {
        "order": [[ 0, "asc" ]]
    });
    });
</script>
@stop 