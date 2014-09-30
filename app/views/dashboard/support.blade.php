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
                          <h4><b>Complaints</b></h4>
                       </div>
                       <div class="col-md-3">
                          <a href="/support/create"><button type="button" class="btn btn-warning pull-right" style="white-space: normal;"><i class="fa fa-minus-square"></i> <b> Create Complaint</b></button></a>
                       </div>
                       </div>
                     </div>  
                      <div class="panel-body">
                        <div class="table-responsive" >
                          <table class="table table-striped table-bordered table-hover" id="soldSelling">
                            <thead>
                              <tr>
                                <th>Ticket</th>
                                <th>Title</th>
                                <th>View</th>
                              </tr>
                             </thead> 
                             <tbody>
                           		@foreach($complaint as $complaint)
                              <tr>
                              	<td>{{$complaint->ticket}}</td>
                                <td>{{$complaint->tittle}}</td>
                                 <td><a href="/support/{{$complaint->ticket}}"><button class="btn btn-primary btn-xs">View Complaint</button></a></td>
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
        "order": [[ 2, "desc" ]]
    });
    });
</script>
@stop 