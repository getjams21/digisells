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
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="userlist">
                                    <thead>
                                         <tr>
                                          <th>Ticket</th>
                                          <th>Titles</th>
                                          <th>View</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         @foreach($complaint as $complaint)
                                          <tr>
                                            <td>{{$complaint->ticket}}</td>
                                            <td>{{$complaint->tittle}}</td></a></td>
                                             <td><a href="/admin-complaints/{{$complaint->ticket}}"><button class="btn btn-primary btn-xs">View Complaint</button></a></td>
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
        $('#userlist').dataTable();
    });
</script>
@stop
@stop