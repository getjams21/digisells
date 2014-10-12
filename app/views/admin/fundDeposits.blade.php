@extends('admin.master.layout')
@section('meta-title', 'Fund_Deposits')
@section('content')
<div class="row">
  <div class="col-lg-12">
      <h1 class="page-header">Fund Deposits</h1>
  </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Deposits
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="deposits">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Method</th>
                                <th>Amount</th>
                                <th>PaymentID</th>
                                <th>Date</th>
                                <th>Invoice</th>
                            </tr>
                        </thead>
                        <tbody>
                             @foreach($deposits as $deposit)
                              <tr> 
                                <td>{{$deposit->username}}</td>
                                <td>{{$deposit->methodName}}</td>
                                <td>{{$deposit->amount}}</td>
                                <td>{{$deposit->paymentID}}</td>
                                <td>{{dateformat($deposit->created_at)}} {{timeformat($deposit->created_at)}}</td> 
                                <td><a href="/admin-deposits/{{$deposit->paymentID}}"><button class="btn btn-info btn-xs">View</button></a></td>
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