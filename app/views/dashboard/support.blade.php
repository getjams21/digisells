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
                    <div class=""><br>
                        <div class="col-md-12"><br>
                     <div class="panel panel-primary">
                      <div class="panel-heading">
                        <div class="row">
                        <div class="col-md-9">
                          <h4><b>Your Tickets</b></h4>
                       </div>
                       <div class="col-md-3">
                          <a href="/support/create"><button type="button" class="btn btn-warning pull-right" style="white-space: normal;"><i class="fa fa-minus-square"></i> <b> New Ticket</b></button></a>
                       </div>
                       </div>
                     </div>  
                      <div class="panel-body">
                        <div class="table-responsive" >
                          <table class="table table-striped table-bordered table-hover" id="soldSelling">
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
                                <td>@if($complaint->senderID != Auth::user()->id)
                                    Admin
                                    @else
                                    You
                                    @endif
                                </td>
                                <td>@if($complaint->solved==0)
                                  <i class="fa fa-play-circle-o"></i>  <i class="warning"> Processing</i>
                                    @else
                                    <i class="success"> <i class="fa fa-check-circle"></i> Solved</i>
                                    @endif
                                </td>
                                 <td><a href="/support/{{$complaint->ticket}}"><button class="btn btn-primary btn-xs">View Details</button></a></td>
                              </tr>
                              @endforeach
                            </tbody>
                          </table>
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
@section('script')
<script type="text/javascript">
   $(document).ready(function() {
        $('#soldSelling').dataTable( {
        "order": [[ 8, "asc" ]]
    });
    });
</script>
@stop 