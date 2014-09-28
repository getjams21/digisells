@extends('admin.master.layout')
@section('meta-title','Summary')
@section('content')
      <div class="row">
          <div class="col-lg-12">
              <h1 class="page-header">Reports Summary</h1>
          </div>
          <!-- /.col-lg-12 -->
      </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="well">
                      {{$summary}}
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
@section('script')

@stop
@stop