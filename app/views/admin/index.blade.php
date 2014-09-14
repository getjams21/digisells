@extends('admin.master.layout')
@section('meta-title','Dashboard')
@section('content')
      <div class="row">
          <div class="col-lg-12">
              <h1 class="page-header">Dashboard</h1>
          </div>
          <!-- /.col-lg-12 -->
      </div>
      <!-- /.row -->
       @include('admin.includes.dashboard.panelNotifications')
       <div class="col-md-8">
       </div>
       <div class="col-md-4" >
        @include('admin.includes.dashboard.notifications')
       </div>
@stop

