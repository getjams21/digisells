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
                            <h4>New Complaint @if($complaint)
                                                 for Ticket No. {{$ticket}}
                                                @endif
                            </h4>
                          </div>
                          <div class="panel-body">
                            {{ Form::open(['method'=>'POST','url'=>'/addComplaint']) }}
                              <div class="form-group input-group">
                                  <span class="input-group-addon">Title: </span>
                               <input type="text" name="title" class="form-control"  value="{{$title->tittle}}" disabled>
                              </div>
                               <input type="hidden" name="newtitle" value="{{$title->tittle}}">
                              <input type="hidden" name="ticket" value="{{$ticket}}">
                              <div class="form-group">
                             <div class="form-group">
                                {{Form::label('description', 'Complaint Details')}}
                                {{Form::textarea('description',null,['class'=>'form-control square','required'=>'required'])}}
                              </div>
                              <div class="form-group"  >
                                {{ Form::Submit('Confirm',['class'=>'btn btn-primary  pull-right']) }}
                              </div>
                          </div>
                            {{ Form::close() }}
                        </div>
                      </div>
                      </div>
                      @if($complaint)
                          <div class="col-md-6">
                              
                             <div class="well">
                              
                                 <div class="panel panel-default">
                                <div class="form-group input-group">
                                  <span class="input-group-addon">Title: </span>
                                  <input type="text"  class="form-control" name="title2" value="{{$title->tittle}}" disabled>
                                </div> 
                                 @foreach($complaint as $complain)
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
                        @endif
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