<!-- Modal for Saving and Uploading -->
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-sm">
    <div class="modal-content modal-prop">
        <!-- progress bar -->
      <div class="progress progress-prop">
          <div class="progress-bar progress-bar-primary" role="progressbar" id="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
            <span id="statustxt">0%</span>
          </div>
      </div>
      <center><span class="glyphicon glyphicon-ok saved"></span><h4 class="saving">Saving...</h4></center>
    </div>
  </div>
</div>
<!-- End Modal -->
<!-- Display Error -->
<div class="panel error-panel square">
    <span class="glyphicon glyphicon-warning-sign error-sign">&nbsp</span><span class="error-msg">Sample text</span>
</div>

<div class="col-md-12">
    <center>
        <br>
        <h2><span>List your Product to Sell</span></h2>
        <div class="product-listing-step-3">
        </div>
    </center>
</div>
    <br>
<div class="jumbotron jmb-prop step-3">
    <div class="container">
    {{ Form::open(['route'=>'product-selling.store','id'=>'directSelling','files'=>true]) }}
        <div class="col-md-10 col-md-offset-1">
            <center><h4>Provide Necessary Files</h4></center>
            <br>
            <hr class="style-fade">
            <br>
        </div>
        <div class="col-md-10 col-md-offset-1">
            <div class="col-md-6 col-md-offset-3 product-listing">
    {{ Form::label('', 'Product Image'); }}
            @include('includes.file-upload.file-upload')
                <center>
                    <button type="button" class='btn btn-primary btn-lg' id='btn-step-2-back'><span class='glyphicon glyphicon-arrow-left'></span></button>&nbsp;
                    <button class="btn btn-primary btn-lg txtbox-s" type="Submit" id="submitSelling"/> <span>Start Selling</span> </button>
                </center>
            </div>                
        </div>
        {{ Form::close() }}
    </div>
</div>