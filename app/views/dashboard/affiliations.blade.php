@extends('layouts.master')
@section('meta-title','Affiliations')
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
                <div class="panel panel-primary">
                <div class="panel-heading">
                  <div class="row">
                    <div class="col-md-10">
                      <h4 class="capital"><b>Your Affiliations</h4></b>
                    </div>
                    <div class="col-md-2">
                    </div>
                  </div>
                </div>  
                <div class="panel-body">
                <div class="table-responsive"> 
                  <table class="table table-striped table-bordered table-hover auctions">
                    <thead>
                      <tr>
                        <th>Event Name</th>
                        <th>Type</th>
                        <th>Referral link</th>
                        <th>Price Range</th>
                        <th>Aff. %</th>
                        <th>Amt. Sold </th>
                        <th>Buyer/s</th>
                        <th>Total Aff. Comm.</th>
                      </tr>
                     </thead> 
                     <tbody>
                        @foreach($affiliations as $affiliations)
                          <tr>
                            <td>@if($affiliations->sellingName)
                               <a href="/direct-selling/{{$affiliations->sellingID}}">{{$affiliations->sellingName}}</a> 
                                @else
                               <a href="/auction-listing/{{$affiliations->auctionID}}">{{$affiliations->auctionName}}</a> 
                                @endif
                            </td>
                            <td>@if($affiliations->sellingName)
                               Direct Selling
                                @else
                              Auction
                                @endif
                            </td>
                            <td>{{$affiliations->referralLink}}</td>
                            <td>@if($affiliations->sellingName)
                              <i class="fa fa-usd"></i>
                               {{money($affiliations->sellingPrice -
                                ($affiliations->sellingPrice * ($affiliations->sellingDiscount / 100)))}}
                                @else
                              <i class="fa fa-usd"></i>
                               {{money($affiliations->minimumPrice)}} - 
                              <i class="fa fa-usd"></i>
                               {{money($affiliations->buyoutPrice)}}
                                @endif
                            </td>
                            <td>@if($affiliations->sellingName)
                               {{$affiliations->sellingAffPerc}} %
                                @else
                                {{$affiliations->auctionAffPerc}} %
                                @endif
                            </td>
                            <td>@if($affiliations->amountSold)
                              <i class="fa fa-usd"></i>
                               {{money($affiliations->amountSold)}}
                              @else
                              N/A
                              @endif
                            </td>
                            <td>@if($affiliations->sellingName)
                              {{ $affiliations->affCount}}
                                @else
                                    @if($affiliations->firstName)
                                    <a href="/users/{{ $affiliations->username}}"> {{ $affiliations->firstName}}</a>
                                    @else
                                    N/A
                                    @endif
                                @endif</td>
                            <td>@if($affiliations->affCount>0)
                                   @if($affiliations->sellingName)  
                                      <i class="fa fa-usd"></i>
                                     <i class="success">  {{money(($affiliations->amountSold * ($affiliations->sellingAffPerc /100)) * $affiliations->affCount)}}</i>
                                   @else
                                      <i class="fa fa-usd"></i>
                                      <i class="success"> {{money(($affiliations->amountSold * ($affiliations->auctionAffPerc /100)) * $affiliations->affCount)}} </i>
                                   @endif
                                 @else
                                     <i class="fa fa-usd"></i> <i class="error"> 0.00</i>
                                 @endif

                            </td>
                         </tr> 
                        @endforeach
                    </tbody>
                  </table>
               </div> <!-- table-responsive -->
               </div><!--panel-body-->
               </div><!--panel-primary-->
               </div><!-- shadowed -->
              </div><!-- row -->
            </div><!-- container-fluid -->
        </div><!-- /#page-content-wrapper -->
    </div><!-- wrapper -->
  </div>  <!-- row -->
@stop
@section('script')
<script type="text/javascript">
   $(document).ready(function() {
        $('.auctions').dataTable( {
        "order": [[ 0, "desc" ]]
    });
    });
</script>
@stop