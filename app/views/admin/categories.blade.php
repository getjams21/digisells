@extends('admin.master.layout')
@section('meta-title', 'Manage_Categories')
@section('content')
@include('admin.includes.categoryModal')
     <!--  <div class="row">
          <div class="col-lg-12">
              <h1 class="page-header">Product Categories</h1>
          </div>
      </div> --><br>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">Manage Categories </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                             <div class="panel panel-primary">
                              <div class="panel-heading">Categories 
                                <button class="btn btn-danger pull-right btn-xs" onclick="addcategory('category');" >Add Category</button></div>
                            <div class="panel-body">
                             <div class="table-responsive">
                                <table  class="table table-striped table-bordered table-hover userlist"  id="category">
                                    <thead>
                                        <tr>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($categories as $category)
                                          <tr id="category{{$category->id}}" onclick="subcategory({{$category->id}})"> 
                                            <td >{{$category->categoryName}}</td>
                                            <td>@if($category->status == 1)
                                                Active
                                                @else 
                                                Inactive
                                                @endif
                                            </td>
                                            <td><button class="btn btn-primary btn-xs"onclick="category({{$category->id}},'category');">Edit</button>
                                            </td>
                                         </tr> 
                                        @endforeach
                                    </tbody>
                               </table>
                              </div>
                             </div>
                            </div><!--category panel -->
                            </div><!--category column -->
                            <div class="col-lg-6">
                            <div class="panel panel-primary">
                            <div class="panel-heading">Subcategories
                             <button class="btn btn-danger pull-right btn-xs" id='catNo' onclick="addcategory('subcategory');" disabled>Add Subcategory</button></div>
                            <div class="panel-body">
                             <div class="table-responsive">
                                <table id="subcategory" class="table table-striped table-bordered table-hover userlist" >
                                    <thead>
                                        <tr>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody id="SubCategory">
                                          <tr> 
                                            <td >Please Choose A Category</td>
                                            <td></td>
                                            <td></td>
                                         </tr> 
                                    </tbody>
                               </table>
                            </div>
                            </div>
                            </div><!--category panel -->
                            </div><!--category column -->
                        </div><!--row-->
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
       $('.userlist').dataTable();
    });

</script>
@stop
@stop