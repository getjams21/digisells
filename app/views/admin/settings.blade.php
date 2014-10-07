@extends('admin.master.layout')
@section('meta-title','Settings')
@section('content')
      <div class="row">
          <div class="col-lg-12">
              <h1 class="page-header">Dynamic Settings</h1> 
          </div>
          <!-- /.col-lg-12 -->
      </div>
      <hr class="style-fade">
        <div class="container-fluid">
        <div class="col-lg-4 col-lg-offset-4">
          <div class="well" >
            <!-- <input class="btn btn-primary"type="button" value="View Daily"> <br> -->
            {{ Form::model($settings, ['method'=>'PATCH','route' => ['admin-dynamic-settings.update', 1]]) }}
                <div class="form">
                  <div class="form-group">
                    <label>Buyer Credit Reward Percentage per Purchase</label>
                    <div class="input-group">
                      <input type="text" name="buyer" class="form-control buyerPercentage" value="{{round($settings->buyer,2)}}">
                      <span class="input-group-addon">%</span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Company Commission Percentage</label>
                    <div class="input-group">
                      <input type="text" name="company" class="form-control companyPercentage" value="{{round($settings->company,2)}}">
                      <div class="input-group-addon">%</div>
                    </div>
                  </div>
                 <div class="form-group">
                  <label>Seller Reward Percentage</label>
                  <div class="input-group">
                    <input type="text" name="reward" class="form-control reward" value="{{round($settings->reward,2)}}">
                    <div class="input-group-addon">%</div>
                  </div>
                </div>
                <div class="form-group">
                  <label>Seller Listing Fee Percentage</label>
                  <div class="input-group">
                    <input type="text" name="fee" class="form-control fee" value="{{round($settings->sellingFee,2)}}">
                    <div class="input-group-addon">%</div>
                  </div>
                </div>
                <center> <button type="submit" class="btn btn-primary">Update</button> </center>
                </div>
            {{ Form::close() }}  
          </div>
        </div>
        </div>
      <div class="container-fluid">
        <center>
          @if (Session::has('flash_message'))
            <div class="form-group ">
              <p>{{Session::get('flash_message') }}</p>
            </div>
          @endif
        </center>
      </div>
@stop