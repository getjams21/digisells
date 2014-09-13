<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="modal-title">Edit Category</h4>
      </div>
      <div class="modal-body">
        <div class="well">
          <div class="row">
          <div class="col-md-8 col-md-offset-2">
           {{ Form::open()}}
           <input type="text" id="catID" hidden>
            <div class="form-group">
              {{Form::label('name', 'Name')}}
              {{Form::text('name',null,['class'=>'form-control square','required'=>'required'])}}
            </div>
            <div class="form-group">
              {{Form::label('description', 'Description')}}
              {{Form::text('description',null,['class'=>'form-control square','required'=>'required'])}}
            </div>
            <div class="form-group" id="statusGroup">
              {{Form::label('status', 'Status')}}<br>
                <div class="btn-group hidden" id="activeStatus">
                <button type="button" class="btn btn-default inactiveCat"  value="0" disabled>Active</button>
                <button type="button" class="btn btn-danger" id="deactivate">Deactivate</button>
                </div>
                <div class="btn-group hidden" id="inactiveStatus">
                <button type="button" class="btn btn-default activeCat" value="1" disabled>Inactive</button>
                <button type="button" class="btn btn-success" id="activate">Activate</button>
                </div>
            </div>
          </div>
         </div>
         </div>
        </div><!--modal body -->
        <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary " id="categoryBtn">Save changes</button>

          {{ Form::close() }}
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->