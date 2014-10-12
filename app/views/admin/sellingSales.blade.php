@extends('admin.master.layout')
@section('meta-title','Selling_Sales')
@section('content')
@include('includes.salesDateModal')
      <div class="row">
          <div class="col-lg-12">
              <h1 class="page-header">Direct Selling Sales</h1>
          </div>
          <!-- /.col-lg-12 -->
      </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                            <div class="col-md-10">
                              <h4 class="capital"><b>Direct Selling Sales</b></h4>
                            </div>
                            <div class="col-md-2">
                            </div>
                          </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover table-responsive" id="datalist">
                                    <thead>
                                        <tr>
                                            <th>Selling Name</th>
                                            <th>Orig. Price</th>
                                            <th>Disc. %</th>
                                            <th>F. Price</th>
                                            <th>Sold</th>
                                            <th>Total Amt.</th>
                                            <th>Company</th>
                                            <th>Credits</th>
                                            <th>Seller</th>
                                            <th>Aff. %</th>
                                            <th>Affs.</th>
                                            <th>Aff. Comm.</th>
                                            <th>Seller</th>
                                            <!-- <th>Event End</th> -->
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         @foreach($sellingSales as $sellingSales)
			                               <tr>
                                            <td><a href="/direct-selling/{{$sellingSales->sellingID}}"> {{$sellingSales->sellingName}}</a></td>
                                            <td><i class="fa fa-usd"></i> 
                                              {{money($sellingSales->price)}}</td>
                                            <td>{{$sellingSales->discount}} %</td>
                                            <td><i class="fa fa-usd"></i>
                                              {{money($sellingSales->amount)}}</td>
                                            <td>{{$sellingSales->buyers}} <button class="btn btn-info btn-xs" onclick="salesDate({{$sellingSales->sellingID}})"><i class="fa fa-list-alt"></i> Details</button></td>
                                            <td><i class="fa fa-usd"></i> 
                                              <i>{{money($sellingSales->amount * $sellingSales->buyers)}}</i></td>
                                            <td><i class="fa fa-usd"></i> 
                                              <i class="success"> {{money((($sellingSales->amount * $sellingSales->buyers) * .09))}}</i></td>
                                              <td><span class="glyphicon glyphicon-certificate"></span> 
                                              <i > {{money(($sellingSales->amount * $sellingSales->buyers) * .01)}}</i></td>
                                            <td><i class="fa fa-usd"></i> 
                                              <i >{{money((($sellingSales->amount * $sellingSales->buyers) * .9)  - 
                                                (($sellingSales->amount * 
                                                ($sellingSales->affiliatePercentage / 100)) * 
                                                ($sellingSales->affiliates)))}}</i></td>
                                            <!-- <td>{{human($sellingSales->endDate)}}</td> -->
                                            <td>{{$sellingSales->affiliatePercentage}} %</td>
                                            <td>{{$sellingSales->affiliates}}</td>

                                             <td><i class="fa fa-usd"></i> 
                                                {{money(($sellingSales->amount * 
                                                ($sellingSales->affiliatePercentage / 100)) * 
                                                ($sellingSales->affiliates))}}</td>
                                            <td><a href="/users/{{$sellingSales->sellerUsername}}"> {{$sellingSales->sellerFirstname}}</a></td>
                                            <td>@if(carbonize($sellingSales->endDate) > Carbon::now())
                                              <span class="alert alert success"> <i class="fa fa-play-circle"></i> Ongoing</span>
                                              @else
                                               <span class="alert alert danger"> <i class="fa fa-stop"></i> Ended</span>
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

@stop         
@section('script')
<script type="text/javascript">
    $(document).ready(function() {
            $('#datalist').dataTable({
            "order": [[ 0, "asc" ]]
        });
        });
</script>
@stop