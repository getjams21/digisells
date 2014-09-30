@extends('admin.master.layout')
@section('meta-title','Summary')
@section('content')
      <div class="row">
          <div class="col-lg-12">
              <h1 class="page-header">Digisells Reports</h1> 
          </div>
          <!-- /.col-lg-12 -->
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="well" >
            <!-- <input class="btn btn-primary"type="button" value="View Daily"> <br> -->
            <div class="row">
              <div class="col-md-6" style="overflow-x: auto;">
                <h4>Daily Sales (since last {{day();}})</h4>
                <canvas id="daily_reports" width="500" height="300"></canvas>
              </div>
              <div class="col-md-6" style="overflow-x: auto;">
                <h4>Details:</h4>
                <table class="table table-striped table-bordered table-hover">
                  <thead>
                    <th>Date</th>
                    <th>Trans.</th>
                    <th>Amount</th>
                    <th>Profit</th>
                  </thead>
                    <tbody>
                      @foreach($dailies as $daily)
                        <tr>
                          <td>{{$daily->date}}</td>
                          <td>{{$daily->count}}</td>
                          <td>{{money($daily->amount)}}</td>
                          <td>{{money($daily->amount * .09)}}</td>
                        </tr>
                      @endforeach 
                    </tbody>
                 </table> 
              </div>
            </div><br>
            <hr class="style-fade">

            <div class="row">
              <h3><b>Overall Summary Report</b></h3><br>
              <div class="col-md-6">
                <div class="row">
                  <h4><b>Fund Activities</b></h4>
                  <div class="table-responsive">
                    <div class="funds">
                      <table class="table table-striped table-bordered table-hover" >
                        <thead>
                          <th>Funds</th>
                          <th class="align-center">Transactions</th>
                          <th class="align-center">Total Amount</th>
                        </thead>
                        <tbody>
                          <tr>
                            <td>Total Deposits</td>
                            <td class="align-center">{{$deposits[0]->count}}</td>
                            <td class="align-right"><i class="fa fa-usd pull-left"></i> <i class="success">{{money($deposits[0]->amount)}}</i></td>
                          </tr>
                          <tr>
                            <td>Total Withdrawals</td>
                            <td class="align-center">{{$withdrawals[0]->count}}</td>
                            <td class="align-right"><i class="fa fa-usd pull-left"></i> <i class="error">{{money($withdrawals[0]->amount)}}</i></td>
                          </tr>
                          <tr>
                            <td colspan="2">Current Fund Total: </td>
                            <td class="align-right"><i class="fa fa-usd pull-left" ></i> <i class="success">{{money($deposits[0]->amount - $withdrawals[0]->amount)}}</i></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>  
                  </div>
                </div>
                <div class="row">
                  <h4><b>Total Sales</b></h4>
                  <div class="table-responsive">
                    <div class="funds">
                      <table class="table table-striped table-bordered table-hover" >
                        <thead>
                          <th>Sales</th>
                          <th class="align-center">Transactions</th>
                          <th class="align-center">Total Amount</th>
                          <th class="align-center">Company</th>
                        </thead>
                        <tbody>
                          <tr>
                            <td>Auction Sales</td>
                            <td class="align-center">{{$auctionSales[0]->count}}</td>
                            <td class="align-right"><i class="fa fa-usd pull-left"></i> <i>{{money($auctionSales[0]->amount)}}</i></td>
                            <td class="align-right"><i class="fa fa-usd pull-left"></i> <i>{{money($auctionSales[0]->amount * .09)}}</i></td>
                          </tr>
                          <tr>
                            <td>D-Seling Sales</td>
                            <td class="align-center">{{$sellingSales[0]->count}}</td>
                            <td class="align-right"><i class="fa fa-usd pull-left"></i> <i>{{money($sellingSales[0]->amount)}}</i></td>
                            <td class="align-right"><i class="fa fa-usd pull-left"></i> <i >{{money($sellingSales[0]->amount * .09)}}</td>
                          </tr>
                          <tr >
                            <td >Total Sales: </td>
                            <td class="align-center">{{$auctionSales[0]->count + $sellingSales[0]->count}}</td>
                            <td class="align-right"><i class="fa fa-usd pull-left" ></i> <i >{{money($auctionSales[0]->amount + $sellingSales[0]->amount)}}</i></td>
                            <td class="align-right"><i class="fa fa-usd pull-left" ></i> <i class="success">{{money(($auctionSales[0]->amount * .09) + ($sellingSales[0]->amount * .09))}}</i></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>  
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="row">
                  <div class="col-md-10 col-md-offset-1">
                  <h4><b>Total User Funds and Credits</b></h4>
                    <div class="table-responsive">
                      <div class="funds">
                        <table class="table table-striped table-bordered table-hover" >
                          <thead>
                            <th class="align-center">Type</th>
                            <th class="align-center">Total Amount</th>
                          </thead>
                          <tbody>
                            <tr>
                              <td>Total Funds</td>
                              <td class="align-right"><i class="fa fa-usd pull-left" ></i> {{money($userfunds[0]->funds)}}</td>
                            </tr>
                            <tr>
                              <td>Total Credits</td>
                              <td class="align-right"><i class="fa fa-usd pull-left" ></i> {{money($usercredits[0]->credits)}}</td>
                            </tr>
                            <tr >
                              <td>Total Amt.</td>
                              <td class="align-right"><i class="fa fa-usd pull-left" ></i> <i>{{money(($userfunds[0]->funds) + ($usercredits[0]->credits))}}</i></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-10 col-md-offset-1">
                    <br>
                  <h4><b>Fund Distributions</b></h4><br>
                      <div class="table-reponsive" style="padding-right:5%;">
                        <p><b>Total Digisells Funds:</b> <i class="pull-right"><b>
                           {{money(($deposits[0]->amount - $withdrawals[0]->amount))}} <b>USD</b></i> </p>
                        <p><b>Total Company Profit:</b> <i class="pull-right success"><b>
                          {{money((($auctionSales[0]->amount * .09) + ($sellingSales[0]->amount * .09)))}} <b>USD</b></i> </p>
                        <hr class="style-fade">
                        <p><b>Total Non-Withdrawable Funds:</b><i class="pull-right"><b>
                           {{money(($deposits[0]->amount - $withdrawals[0]->amount) - (($auctionSales[0]->amount * .09) + ($sellingSales[0]->amount * .09)) )}} USD</b></i> </p>
                        </table>
                      </div>
                  </div>
                </div>
              </div>
            </div>
            
          </div>
        </div>
              <!-- /.col-lg-12 -->
      </div>
@section('script')
    {{ HTML::script('_/js/chart.min.js') }}
  <script type="text/javascript">
  (function(){
      var ctx = $('#daily_reports').get(0).getContext('2d');
      var chart = {
        labels: {{json_encode($dates)}},
        datasets:[{
            label: "Direct Selling Sales",
            fillColor: "rgba(220,220,220,0.2)",
            strokeColor: "rgba(220,220,220,1)",
            pointColor: "rgba(220,220,220,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(220,220,220,1)",
            data:  {{json_encode($amounts)}}
        }]
      };

      new Chart(ctx).Line(chart);
  })();
  </script>
@stop
@stop