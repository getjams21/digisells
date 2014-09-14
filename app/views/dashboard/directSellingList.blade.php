@extends('layouts.master')
@section('meta-title','Direct')
@section('header')
	@include('includes.navbar')
@stop
@section('content')
<div clas="row" >
  <div id="wrapper">
    @include('dashboard.includes.dashboardNavbar')
      <div id="page-content-wrapper">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12 shadowed"><br>
              <div class="panel panel-primary">
              <div class="panel-heading"><h4 class="capital"><b>Your Direct Selling List</h4></b></div>
              <div class="panel-body">
              <div class="table-responsive" >
                <table class="table table-striped table-bordered table-hover selling">
                  <thead>
                    <tr>
                      <th>Sale Name</th>
                      <th>Qty</th>
                      <th>Amount</th>
                      <th>Date Created</th>
                      <th>End Date</th>
                      <th>Qty Sold</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($selling as $selling)
                        <tr>
                          <td>{{$selling->sellingName}}</td>
                          <td>{{$selling->quantity}}</td>
                          <td>{{$selling->price}}</td>
                          <td>{{date("d F Y",strtotime($selling->created_at)) }} at {{ date("g:ha",strtotime($selling->created_at)) }}</td>
                          <td>{{date("d F Y",strtotime($selling->expirationDate)) }} at {{ date("g:ha",strtotime($selling->expirationDate)) }}</td>
                          <td>0</td>
                          <td>
                            @if($selling->sold==0)
                             <p style="color:green;"><b>AVAILABLE</b></p>
                            @else
                              <p style="color:red;"><b>ENDED</b></p>
                            @endif
                          </td>
                       </tr> 
                      @endforeach
                  </tbody>
                </table>
              </div><!--table-responsive-->
             </div> <!--panel-body-->
            </div><!--panel-primary-->
            </div><!--shadowed-->
          </div><!--row-->
        </div><!--container-fluid-->
      </div><!--table-responsive-->
  </div><!--wrapper-->
</div>  <!--row-->
@stop
@section('script')
<script type="text/javascript">
   $(document).ready(function() {
        $('.selling').dataTable( {
        "order": [[ 3, "desc" ]]
    });
    });
</script>
@stop