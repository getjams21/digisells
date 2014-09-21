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
                                <th>Auction Name</th>
                                <th>Buyout Price</th>
                                <th>Current Max Bid</th>
                                <th>Your Bid</th>
                                <th>Event End Date</th>
                                <th>Event Status</th>
                              </tr>
                            </thead>
                            <tbody>
                               @foreach($inactivebids as $inactivebid)
                              <tr>
                                <td><a href="auction-listing/{{$inactivebid->id}}">{{$inactivebid->auctionName}}</a></td>
                                <td>{{round($inactivebid->buyoutPrice,2)}}</td>
                                <td>{{round($inactivebid->maxBid,2)}}</td>
                                <td><i class="error"> {{round($inactivebid->amount,2)}}</i></td>
                                <td>{{human($inactivebid->endDate)}}</td>
                                <td>
                                   @if(carbonize($inactivebid->endDate) > Carbon::now() && $inactivebid->sold==0)
                                   <span class="success"> <i class="fa fa-play-circle"></i> Ongoing</span>
                                  @else
                                       <span class="error"> <i class="fa fa-stop"></i> Ended</span>

                                  @endif
                                 </td>
                              </tr>
                              @endforeach
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