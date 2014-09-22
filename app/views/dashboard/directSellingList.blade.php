@extends('layouts.master')
@section('meta-title','Direct Selling')
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
               <div class="panel-heading">
                  <div class="row">
                    <div class="col-md-10">
                      <h4 class="capital"><b>Your Auction List</h4></b>
                    </div>
                    <div class="col-md-2">
                      <select class="form-control" onchange="location = this.options[this.selectedIndex].value;">
                         <option value="/directSellingList?status=current">Current</option>
                         <option value="/directSellingList?status=expired" <?php if($status =='expired'){echo 'selected';}?>>Expired</option>
                      </select>
                    </div>
                  </div>
                </div>  
              <div class="panel-body">
              <div class="table-responsive" >
                <table class="table table-striped table-bordered table-hover selling">
                  <thead>
                    <tr>
                      <th>Selling Name</th>
                      <th>Price</th>
                      <th>Discount</th>
                      <th>Qty Sold</th>
                      <th>Event Started</th>
                      <th>Event Ending</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($selling as $selling)
                        <tr>
                          <td><a href="/direct-selling/{{$selling->id}}">{{$selling->sellingName}}</a></td>
                          <td>{{$selling->price}}</td>
                          <td>{{$selling->discount}}</td>
                           <td>{{$selling->count}}</td>
                          <td>{{Human($selling->listingDate)}}</td>
                          <td>{{Human($selling->expirationDate)}}</td>
                          <td>
                             @if(carbonize($selling->expirationDate) > Carbon::now())
                                <span class="success"> <i class="fa fa-play-circle"></i> Active</span>
                              @else
                                <span class="error"> <i class="fa fa-stop"></i> Expired</span>
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