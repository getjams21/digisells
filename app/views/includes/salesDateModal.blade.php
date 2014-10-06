<div class="modal fade" id="salesDateModal">
  <div class="modal-dialog">
    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	        <h4 class="modal-title" id="modal-title">Sales Details</h4>
	      	</div>
      	<div class="modal-body">
      		<div class="row well">
      			<input type='text' hidden id="ticket" >
      			<div class="table-responsive">
              <table class="table table-striped table-bordered table-hover" id="salesTable">
                <thead>
                    <th>Buyer</th>
                    <th>Qty</th>
                    <th>Amount</th>
                    <th>Date</th>
                </thead>
                <tbody id="salesTableBody">
                </tbody>
              </table>

            </div>  
      		</div>
        </div><!--modal body -->
        <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->