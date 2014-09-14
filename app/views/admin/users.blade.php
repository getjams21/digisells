@extends('admin.master.layout')
@section('meta-title',$body)
@section('content')
      <div class="row">
          <div class="col-lg-12">
              <h1 class="page-header">User Accounts</h1>
          </div>
          <!-- /.col-lg-12 -->
      </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            @if($status==1)Active @else Inactive @endif Users
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="userlist">
                                    <thead>
                                        <tr>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Full Name</th>
                                            <th>Funds</th>
                                            <th>Last Active</th>
                                            <th>Role</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         @foreach($users as $user)
			                              <tr> 
			                                <td>{{$user->username}}</td>
			                                <td>{{$user->email}}</td>
			                                <td>@if(!$user->firstName) <i>NULL</i>
			                                	@else{{$user->firstName." ".$user->lastName}}
			                                	@endif
			                                </td>
			                                <td>{{$user->fund}}</td>
			                                <td>{{carbonize($user->last_activity)->diffForHumans()}}</td>
			                                <td>{{$user->role}}</td>
			                                <td>@if($user->status == 1)
			                                	Active
			                                	@else 
			                                	Inactive
			                                	@endif
			                                </td>
			                             </tr> 
			                            @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                            <!-- <div class="well">
                                <h4>DataTables Usage Information</h4>
                                <p>DataTables is a very flexible, advanced tables plugin for jQuery. In SB Admin, we are using a specialized version of DataTables built for Bootstrap 3. We have also customized the table headings to use Font Awesome icons in place of images. For complete documentation on DataTables, visit their website at <a target="_blank" href="https://datatables.net/">https://datatables.net/</a>.</p>
                                <a class="btn btn-default btn-lg btn-block" target="_blank" href="https://datatables.net/">View DataTables Documentation</a>
                            </div> -->
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