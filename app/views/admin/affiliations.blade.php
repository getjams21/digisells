@extends('admin.master.layout')
@section('meta-title','Affiliations')
@section('content')
      <div class="row">
          <div class="col-lg-12">
              <h1 class="page-header">Affiliation Sales</h1>
          </div>
          <!-- /.col-lg-12 -->
      </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-10">
                              Affiliations
                            </div>
                            <div class="col-md-2">
                              
                            </div>
                          </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="userlist">
                                    <thead>
                                        <tr>
                                            <th>Event Name</th>
                                            <th>Type</th>
                                            <th>Amount Sold</th>
                                            <th>Buyers</th>
                                            <th>Aff. %</th>
                                            <th>Aff. Comm.</th>
                                            <th>Affiliate</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         @foreach($affiliations as $affiliations)
			                                   <tr>  
                                           <td>
                                              @if($affiliations->sellingName)
                                               <a href="/direct-selling/{{$affiliations->sellingID}}">{{$affiliations->sellingName}}</a> 
                                              @else
                                               <a href="/auction-listing/{{$affiliations->auctionID}}">{{$affiliations->auctionName}}</a> 
                                              @endif
                                           </td>  
                                           <td>
                                              @if($affiliations->sellingName)
                                                 Direct Selling
                                              @else
                                                 Auction
                                              @endif
                                           </td> 
                                           <td> 
                                              @if($affiliations->amountSold)
                                               <i class="fa fa-usd"></i>
                                               {{money($affiliations->amountSold)}}
                                              @else
                                               N/A
                                              @endif
                                           </td>
                                           <td>
                                              {{$affiliations->affCount}}
                                           </td>
                                           <td>
                                              @if($affiliations->sellingName)
                                                {{$affiliations->sellingAffPerc}} %
                                              @else
                                                 {{$affiliations->auctionAffPerc}} %
                                              @endif
                                           </td>
                                           <td>
                                              @if($affiliations->sellingName)  
                                                  <i class="fa fa-usd"></i>
                                                 <i class="success">  {{money(($affiliations->amountSold * ($affiliations->sellingAffPerc /100)) * $affiliations->affCount)}}</i>
                                               @else
                                                  <i class="fa fa-usd"></i>
                                                  <i class="success"> {{money(($affiliations->amountSold * ($affiliations->auctionAffPerc /100)) * $affiliations->affCount)}} </i>
                                               @endif
                                           </td> 
                                           <td>
                                              @if($affiliations->firstName)
                                              <a href="/users/{{ $affiliations->username}}"> {{ $affiliations->firstName}}</a>
                                              @else
                                              N/A
                                              @endif
                                        
                                           </td>      
                                         </tr>  
			                            @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                            <!-- <div class="well">
                                <h4>DataTables Usage Information</h4>
                                <p>DataTables is a very flexible, advanced tables plugin for jQuery. In SB Admin, we are using a specialized version of DataTables built for Bootstrap 3. We have also customized the table headings to use Font Awesome icons in place of images. For complete documentation on DataTables, visit their website at <a target="_blank" href="https://datatables.net/">https://datatables.net/</a>.</p>
                                <a class="btn btn-default btn-lg btn-block" target="_blank" href="https://datatables.net/">View DataTables Documentation</a>
                            </div> -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        $('#userlist').dataTable();
    });
</script>
@stop
@stop