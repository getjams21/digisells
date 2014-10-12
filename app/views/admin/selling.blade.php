@extends('admin.master.layout')
@section('meta-title','Selling_List')
@section('content')
      <div class="row">
          <div class="col-lg-12">
              <h1 class="page-header">Selling Events</h1>
          </div>
          <!-- /.col-lg-12 -->
      </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-10">
                              <h4 class="capital"><b><?php if($expired ==1){echo 'Expired';}else{ echo 'Current';}?> Selling List</h4></b>
                            </div>
                            <div class="col-md-2">
                              <select class="form-control" onchange="location = this.options[this.selectedIndex].value;">
                                 <option value="/admin-selling?expired=0">Current</option>
                                 <option value="/admin-selling?expired=1" <?php if($expired ==1){echo 'selected';}?>>Expired</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="userlist">
                                    <thead>
                                        <tr>
                                            <th>Selling Name</th>
                                            <th>Orig. Price</th>
                                            <th>Discount</th>
                                            <th>Selling Price</th>
                                            <th>Aff. %</th>
                                            <th>Sold</th>
                                            <th>Event Started</th>
                                            <th>Event Ending</th>
                                            <th>Seller</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         @foreach($selling as $selling)
                                      <tr>
                                        <td><a href="/direct-selling/{{$selling->id}}">{{$selling->sellingName}}</a></td>
                                        <td><i class="fa fa-usd"></i> 
                                          {{money($selling->price)}}</td>
                                        <td>{{$selling->discount}} %</td>
                                        <td><i class="fa fa-usd"></i> 
                                          {{money($selling->price-($selling->price * ($selling->discount / 100)))}}</td>
                                        <td>{{$selling->affiliatePercentage}} %</td>
                                        <td>@if($selling->count)
                                          {{$selling->count}}
                                          @else
                                            0
                                          @endif</td>
                                        <td>{{Human($selling->listingDate)}}</td>
                                        <td>{{Human($selling->expirationDate)}}</td>
                                        <td><a href="/users/{{$selling->sellerUsername}}">{{$selling->seller }}</a> </td>
                                        <td>
                                           @if(carbonize($selling->expirationDate) > Carbon::now())
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