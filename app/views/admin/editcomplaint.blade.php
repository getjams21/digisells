@extends('admin.master.layout')
@section('meta-title','Complaints')
@section('content')
      <div class="row">
          <div class="col-lg-12">
              <h1 class="page-header">Complaints</h1>
          </div>
          <!-- /.col-lg-12 -->
      </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-10">
                             
                            </div>
                            <div class="col-md-2">
                              
                            </div>
                          </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="well">
                     
                  <div class="row">
                    <div class="col-md-12">
                      <div class="col-md-6">
                        <div class="panel panel-primary">
                          <div class="panel-heading">
                            <h4>New Complaint for Ticket No. {{$ticket}}               
                            </h4>
                          </div>
                          <div class="panel-body">
                            {{ Form::open(['method'=>'POST','url'=>'/addComplaint']) }}
                              <div class="form-group input-group">
                                  <span class="input-group-addon">Title: </span>
                                  <input type="text" name="title" class="form-control" placeholder="Complaint Title" value="{{$title->tittle}}" disabled>
                              </div>
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
                          <div class="col-md-6">
                              
                             <div class="well">
                              
                                 <div class="panel panel-default">
                                <div class="form-group input-group">
                                  <span class="input-group-addon">Title: </span>
                                  <input type="text" name="title3" class="form-control" placeholder="Complaint Title" value="{{$title->tittle}}" disabled>
                                </div> 
                                 @foreach($complaints as $complain)
                                    <div class="panel-body">
                                     <span class="pull-left"><b>SENDER:</b><i>
                                      {{$complain->firstName}}</i></span> 
                                      <span class="pull-right"><b>SENT:</b><i> 
                                        {{$complain->created_at}}</i></span>
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
            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        $('#userlist').dataTable();
    });
</script>
@stop
@stop