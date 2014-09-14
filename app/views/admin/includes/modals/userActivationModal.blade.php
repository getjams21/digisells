<div class="modal fade" id="userActivationModal">
  <div class="modal-dialog">
    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	        <h4 class="modal-title" id="modal-title">Deactivate User</h4>
	      	</div>
      	<div class="modal-body">
      		<div class="row well">
      			<input type='text' hidden id="user_id" >
      			<div class="col-md-2">
      				<i class="fa fa-times fa-5x" style="color:red;"></i></div>
      			<div class="col-md-9">
      			<h4>Do you want to deactivate this user?<br>
      			<small>If the user is deactivated, the account and
      				all its activities will be set to inactive.</small></h3>
      			</div>
      			<div class="col-md-1"></div>
      		</div>
        </div><!--modal body -->
        <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger " id="deactivateUserBtn" >Deactivate</button>

      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->