@extends('layouts.master')
@section('meta-title', $event)
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
            <div class="col-md-12 shadowed">
              <div class=""><br>
                   @include('dashboard.includes.watchlist')
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
</div>  
@stop
@section('script')
<script type="text/javascript">
   $(document).ready(function() {
        $('.watchlist').dataTable( {
        "order": [[ 3, "desc" ]]
    });
    });
</script>
@stop