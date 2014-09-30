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
                            <h4>New Complaint 
                            </h4>
                          </div>
                          <div class="panel-body">
                            {{ Form::open(['route'=>'support.store']) }}
                              <div class="form-group input-group">
                                  <span class="input-group-addon">Title: </span>
                                  <input type="text" name="title" class="form-control" placeholder="Complaint Title"  required>
                              </div>
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