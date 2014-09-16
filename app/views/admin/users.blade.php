@extends('admin.master.layout')
@section('meta-title',$body)
@section('content')
@include('admin.includes.modals.roleModal')
@include('admin.includes.modals.userActivationModal')
<div class="row">
  <div class="col-lg-12">
      <h1 class="page-header">User Accounts</h1>
  </div>
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
                                <th>Name</th>
                                <th>Funds</th>
                                <th>Last Active</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Update</th>
                            </tr>
                        </thead>
                        <tbody>
                             @foreach($users as $user)
                              <tr id="user{{$user->id}}"> 
                                <td>{{$user->username}}</td>
                                <td>{{$user->email}}</td>
                                <td>@if(!$user->firstName) <i>NULL</i>
                                	@else{{$user->firstName." ".$user->lastName}}
                                	@endif
                                </td>
                                <td>{{$user->fund}}</td>
                                <td>{{carbonize($user->last_activity)->diffForHumans()}}</td>
                                <td>{{$user->role}} 
                                    @if($user->status == 1 && $user->id != Auth::user()->id && $user->id !=1)
                                        <button class="btn btn-info btn-xs"onclick="editRole({{$user->id}});">Edit</button>
                                    @endif
                                </td>
                                <td>@if($user->status == 1)
                                	Active 
                                        @if($user->id != Auth::user()->id && $user->id !=1)
                                        <button class="btn btn-danger btn-xs" onclick="deactivateUser({{$user->id}});"><i class="fa fa-times"></i></button>
                                        @endif
                                	@else
                                	Inactive <button class="btn btn-success btn-xs" onclick="activateUser({{$user->id}});"><i class="fa fa-check"></i></button>
                                	@endif
                                </td>
                                <td>
                                   <a href="admin-users/{{$user->username}}/edit"> <button class="btn btn-warning btn-xs">Update</button></a>
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
@stop
@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        $('#userlist').dataTable({
        "order": [[ 5, "asc" ]]
    });
    });
</script>
@stop