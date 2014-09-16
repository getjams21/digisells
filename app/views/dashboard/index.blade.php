@extends('layouts.master')
@section('meta-title','Notifications')
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
              <br>
                <div class="panel panel-primary">
                    <div class="panel-heading"><h4 class="capital"><b>Your Latest Notifications</h4></b></div>
                    <div class="panel-body">
                    <div class="table-responsive" >
                      <table class="table table-bordered table-hover" id="notifications">
                        <thead>
                          <tr>
                            <th>Activity</th>
                            <th>Date</th>
                            <th>Status</th>
                          </tr>
                        </thead> 
                        <tbody>
                          @foreach($notifications as $notification)
                              <tr class="<?php if($notification['is_read'] == 0){echo "unread";};?>">
                                <td class="notifID hidden">{{$notification['id']}}</td>
                                <td>@if($notification['subject']=='Someone')
                                    {{$notification['subject']}}
                                    @else
                                    <a href="/users/{{$notification['subject']}}"><b>{{$notification['subject']}}</b></a>
                                    @endif
                                   {{$notification['body']}} 
                                </td>
                                <td>{{carbonize($notification['sent_at'])->diffForHumans();}}</td>
                                <td class="readStatus"><i>
                                  @if($notification['is_read'] == 1)
                                  Read
                                  @else
                                  Unread
                                  @endif
                                </i></td>
                              </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div><!--table responsive-->
                  </div><!--panel-body-->
                </div><!--tpanel-primary-->
              </div><!--shadowed-->
          </div><!--row-->
        </div><!--container fluid-->
      </div><!--page content wrapper-->
  </div><!--wrapper-->
</div>  <!--row-->
@stop
@section('script')
<script type="text/javascript">
   // $(document).ready(function() {
   //      $('#notifications').dataTable({
   //      "order": [[ 1, "desc" ]]
   //    });
   //  });
</script>
@stop