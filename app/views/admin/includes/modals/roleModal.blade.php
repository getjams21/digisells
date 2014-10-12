<div class="modal fade" id="roleModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="modal-title">Update Role</h4>
      </div>
      <div class="modal-body">
        <div class="well">
          <div class="row">
          <div class="col-md-8 col-md-offset-2">
           {{ Form::open()}}
           <input type="text" id="userID" hidden>
            <div class="form-group" id="adminGroup">
              {{Form::label('admin', 'Admin')}}<br>
                <div class="btn-group" id="activeAdmin">
                <button type="button" class="btn btn-default activeAdmin"  value="1" disabled>Active</button>
                <button type="button" class="btn btn-danger" id="deactivateAdmin">Remove Role</button>
                </div>
                <div class="btn-group hidden" id="inactiveAdmin">
                <button type="button" class="btn btn-default inactiveAdmin" value="0" disabled>Inactive</button>
                <button type="button" class="btn btn-success" id="activateAdmin">Add Role</button>
                </div>
            </div>
             <div class="form-group" id="ownerGroup">
              {{Form::label('owner', 'Owner')}}<br>
                <div class="btn-group" id="activeOwner">
                <button type="button" class="btn btn-default activeOwner"  value="1" disabled>Active</button>
                <button type="button" class="btn btn-danger" id="deactivateOwner" >Remove Role</button>
                </div>
                <div class="btn-group hidden" id="inactiveOwner">
                <button type="button" class="btn btn-default inactiveOwner" value="0" disabled>Inactive</button>
                <button type="button" class="btn btn-success" id="activateOwner" >Add Role</button>
                </div>
            </div>
          </div>
         </div>
         </div>
        </div><!--modal body -->
        <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary " id="roleBtn" >Save changes</button>

          {{ Form::close() }}
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->