@extends('layouts.master')
@section('meta-title','Inactive')
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
                  <div class="col-md-12 shadowed"><br>
                      <h4 class="capital"><b><a href="/users/{{Auth::user()->username}}">{{ Auth::user()->username }}'s</a> Inactive Bids</h4></b>
                      <hr >
                        <div class="col-md-12">
                        <div class="panel panel-primary">
                        <div class="panel-heading">Inactive Bids</div>
                        <div class="panel-body">
                        <div class="table-responsive">
                          <table class="table table-striped table-bordered table-hover" id="inactivebids">
                            <thead>
                              <tr>
                                <th>Bid ID</th>
                                <th>Amount</th>
                                <th>Time</th>
                                <th>Ending</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                        </div>
                        </div>
                      </div>
                  </div><!-- col-md-12 -->
               </div><!--row -->
           </div><!-- container-fluid -->
      </div>    <!-- /#page-content-wrapper -->
    </div>
  </div>  
@stop
@section('script')
<script type="text/javascript">
   $(document).ready(function() {
        $('#inactivebids').dataTable( {
        "order": [[ 0, "desc" ]]
    });
    });
</script>
@stop 