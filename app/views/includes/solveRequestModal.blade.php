<div class="modal fade" id="solveRequestModal">
  <div class="modal-dialog">
    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	        <h4 class="modal-title" id="modal-title">Request Solved</h4>
	      	</div>
      	<div class="modal-body">
      		<div class="row well">
      			<input type='text' hidden id="ticket" >
      			<div class="col-md-2">
              <i class="fa fa-check-circle fa-5x success"></i></div>
      			<div class="col-md-9">
      			<h4>Do you want to mark this Request as Solved?<br>
      			<small>If the request is marked solved, the request will
      				not be shown on the Admins' priority list.<br>
      				Reply will also be diabled.
      			</small></h3>
      			</div>
      			<div class="col-md-1"></div>
      		</div>
        </div><!--modal body -->
        <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <a href="/solveRequest/{{$complaint[0]->ticket}}"><button type="button" class="btn btn-success " >Solved</button></a>

      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->