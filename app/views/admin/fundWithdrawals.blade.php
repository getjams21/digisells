@extends('admin.master.layout')
@section('meta-title', 'Fund_Withdrawals')
@section('content')
<div class="row">
  <div class="col-lg-12">
      <h1 class="page-header">Fund Withdrawals</h1>
  </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Withdrawals
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="deposits">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Amount</th>
                                <th>Paykey</th>
                                <th>Date</th>
                                <th>Invoice</th>
                            </tr>
                        </thead>
                        <tbody>
                             @foreach($withdrawals as $withdrawal)
                              <tr> 
                                <td>{{$withdrawal->username}}</td>
                                <td>{{$withdrawal->email}}</td>
                                <td>{{$withdrawal->amount}}</td>
                                <td>{{$withdrawal->paykey}}</td>
                                <td>{{dateformat($withdrawal->created_at)}} {{timeformat($withdrawal->created_at)}}</td> 
                                <td><button class="btn btn-info btn-xs">View</button></td>
                             </tr> 
                            @endforeach
                        </tbody>
                    </table>
                </div>
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
            $('#deposits').dataTable({
            "order": [[ 1, "asc" ]]
        });
        });
    </script>
    @stop
@stop