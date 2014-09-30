@extends('admin.master.layout')
@section('meta-title','Dashboard')
@section('content')
      <div class="row">
          <div class="col-lg-12">
              <h1 class="page-header">Dashboard <small>- This week's activities</small></h1>
          </div>
          <!-- /.col-lg-12 -->
      </div>
      <!-- /.row -->
       @include('admin.includes.dashboard.panelNotifications')
       <div class="row">
         <div class="col-md-12">
            <div class="row">
              <div class="well" style="overflow-x: auto;">
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
              </div>
            </div>
         </div>
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

