@extends('admin.master.layout')
@section('meta-title','Complaints')
@section('content')
      <div class="row">
          <div class="col-lg-12">
              <h1 class="page-header">Requests</h1>
          </div>
          <!-- /.col-lg-12 -->
      </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-10">
                             Request Tickets
                            </div>
                            <div class="col-md-2">
                              
                            </div>
                          </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="userlist">
                                    <thead>
                                         <tr>
                                          <th>Ticket No.</th>
                                          <th>Category</th>
                                          <th>Priority</th>
                                          <th>Title</th>
                                          <th>Screenshot</th>
                                          <th>Request Date</th>
                                          <th>Replies</th>
                                          <th>Last Msg.</th>
                                          <th>Status</th>
                                          <th>View</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         @foreach($complaint as $complaint)
                                          <tr>
                                            <td>{{$complaint->ticket}}</td>
                                            <td>{{$complaint->category}}</td>
                                            <td>{{$complaint->priority}}</td>
                                            <td>{{$complaint->title}}</td>
                                            <td>@if($complaint->screenshot)
                                                <a href="/images/screenshots/{{$complaint->screenshot}}" target="_blank"><button class="btn btn-primary btn-xs" ><i class="fa fa-file-image-o"></i> &nbsp;View</button></a>
                                                @else
                                                N/A
                                                @endif
                                            </td>
                                            <td>{{dateformat($complaint->created_at)}} at {{timeformat($complaint->created_at)}}</td>
                                            <td>{{$complaint->replies}}</td>
                                            <td><a href="/users/{{$complaint->username}}">{{$complaint->firstName}}</a>
                                            </td>
                                            <td>@if($complaint->solved==0)
                                              <i class="fa fa-play-circle-o"></i>  <i class="warning"> Processing</i>
                                                @else
                                              <i class="success"> <i class="fa fa-check-circle"></i> Solved</i>
                                                @endif
                                            </td>
                                             <td><a href="/admin-complaints/{{$complaint->ticket}}"><button class="btn btn-primary btn-xs">View Details</button></a></td>
                                          </tr>
                                          @endforeach
                                    </tbody>
                                </table>
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
        $('#userlist').dataTable({
        "order": [[ 8, "asc" ]]
    });
    });
</script>
@stop
@stop