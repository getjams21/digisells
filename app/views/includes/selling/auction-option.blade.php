<br>
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
<!-- Error Message Panel -->

<div class="panel error-panel square">
    <span class="glyphicon glyphicon-warning-sign error-sign">&nbsp</span><span class="error-msg">Sample text</span>
</div>
<!-- Auction Container -->
<div class="container">
	<div class="col-md-12 offset-3">
        <h2>Start an Auction Event</h2>
		<hr class="style-shadowed">
        @if (Session::has('flash_message'))
            <div class="form-group ">
                <p>{{Session::get('flash_message') }}</p>
            </div>
        @endif
	</div>
    {{ Form::open(['route'=>'auction-listing.store','id'=>'fileupload','files'=>true]) }}
	<div class="col-md-12">
        <div class="col-md-6">
            {{ Form::label('Category', 'Select Category'); }}
            {{ Form::select('Category',$category,
                Input::old('Category'),
                array('class'=>'form-control sqaure','id'=>'selectCategory')) }}
        </div>
        <div class="col-md-6">
            {{ Form::label('SCategory', 'Select Sub Category'); }}
            {{ Form::select('SubCategory',
                $subCategories,
                null,
                array('class'=>'form-control sqaure', 'id'=>'subCategory')) }}
        </div>
	</div>
    <div class="col-md-12">
        <br>
            <h4>Product and Event Information</h4>
        <hr class="style-fade">
    </div>
    <div class="col-md-12">
        <br>
        <div class="well auction-page">
            <div class="col-md-6">
                {{ Form::label('', 'Auction Name'); }}
                {{ Form::text('auctionName','',
                    array(
                    'class'=>'form-control span3 txtbox-m',
                    'placeholder'=>'Name/Title of Auction',
                    'id'=>'AuctionName',
                    'required'=>'required'
                    )) }}
                <br>
                {{ Form::label('', 'Starting Price'); }}
                <div class="input-group txtbox-s">
                    <span class="input-group-addon">$</span>
                    {{ Form::text('minimumPrice','',
                    array(
                        'class'=>'form-control span3',
                        'placeholder'=>'Starting Price',
                        'id'=>'MinimumPrice',
                        'required'=>'required'
                    )) }}
                </div>
                <br>
                {{ Form::label('', 'Buyout Price'); }}
                <div class="input-group txtbox-s">
                    <span class="input-group-addon">$</span>
                    {{ Form::text('buyoutPrice','',
                    array(
                        'class'=>'form-control span3',
                        'placeholder'=>'Buyout Price',
                        'id'=>'buyoutPrice'
                    )) }}
                </div>
                <br>
                {{ Form::label('', 'Start Date'); }}
                <div class="form-group row">
                  <div class="col-xs-8">
                    <div class="input-group date txtbox-m" id="grp-startDate" data-date-format="mm-dd-yyyy">
                      <input class="form-control" id="startDate" name="startDate" type="text" readonly required>
                      <span class="input-group-addon calendar-icon"><i class="glyphicon glyphicon-calendar"></i></span>
                    </div>
                  </div>
                </div>  
                {{ Form::label('', 'End Date'); }}
                <div class="form-group row">
                  <div class="col-xs-8">
                    <div class="input-group date txtbox-m" id="grp-endDate" data-date="" data-date-format="mm-dd-yyyy">
                      <input class="form-control" type="text" id="endDate" name="endDate" readonly required>
                      <span class="input-group-addon calendar-icon"><i class="glyphicon glyphicon-calendar"></i></span>
                    </div>
                  </div>
                </div>
                {{ Form::label('', 'Incrementation Option'); }}
                <div class="input-group">
                    <div class="btn-group">
                      <button type="button" class="btn btn-primary active" id="standard" data-container="body" data-toggle="popover" placement="left" data-content="Select Standard way of bidding incrementation rule. The minimum next bid will be the last bid price + its 5% or higher.">Standard</button>
                      <button type="button" class="btn btn-primary" id="customized" data-container="body" data-toggle="popover" placement="left" data-content="Select Customized way of bidding incrementation rule. The minimum next bid will be the last bid price plus the value you indicated or higher.">Customized</button>
                    </div>
                    <div class="well next-bid-info">
                        <center><p>Next bid price must be:<b><br><span name='bidPrice' id='bid-price'></span><br></b>or Higher
                        </p></center>
                    </div>
                    <div class="well customized-bid">
                        {{ Form::label('', 'Incremented by:'); }}
                    <div class="input-group">
                        <span class="input-group-addon">$</span>
                        {{ Form::text('incrementation','0',
                        array(
                        'class'=>'form-control span3 square',
                        'placeholder'=>'Increment value',
                        'id'=>'bidIncrement'
                        )) }}
                    </div>
                        <center><p>Next bid price must be:<b><br><span name='customBid' id='customBid'></span><br></b>or Higher
                        </p></center>
                    </div>
                    <div class="input-group">
                    <br>
                    <div class="alert alert-warning validateAffOption" role="alert">
                        <center><p><font color="orange"><span class="glyphicon glyphicon-warning-sign"></span></font>&nbsp Product Affiliation is <br>currently disabled.</p>
                        <button type="button" class="btn btn-primary" id="affiliation" data-container="body" data-toggle="popover" placement="left" data-content="Enable Affiliation Program for this product to boost your sales. With this feature, our members can promote this product anytime, anywhere."><span class="glyphicon glyphicon-ok"></span>&nbsp Let Affiliates promote this!</button></center>
                    </div>
                    <br>
                    <div class="well affiliation">
                        {{ Form::label('', 'Affiliate Commission Percentage'); }}
                    <div class="input-group txtbox-m">
                        {{ Form::text('affiliatePercentage','',
                        array(
                            'class'=>'form-control span3',
                            'placeholder'=>'Commission',
                            'id'=>'affiliatePercentage'
                        )) }}
                        <span class="input-group-addon">%</span>
                    </div>
                    <br>
                    <hr class='style-fade'>
                    <br>
                    <center><button type="button" class='btn btn-danger' id='disableAffiliation'><span class='glyphicon glyphicon-remove'></span>&nbsp; No, I don't need Affiliation</button></center>
                    </div>
                    <!-- div for affiliation option warning -->
                </div>
                </div>
            </div>
            <div class="container">
               <div class="col-md-5">
                {{ Form::label('', 'Product Name'); }}
                {{ Form::text('ProductName','',
                    array(
                    'class'=>'form-control span3 txtbox-m',
                    'placeholder'=>'Name your product',
                    'id'=>'productName',
                    'required'=>'required'
                    )) }}
                <br>
                {{ Form::label('', 'Product Description'); }}
                {{ Form::textarea('ProducteDescription','',
                    array(
                    'class'=>'form-control span3 txtbox-m',
                    'placeholder'=>'Describe your product',
                    'id'=>'productDesc',
                    'required'=>'required'
                    )) }}
                <br>
                {{ Form::label('', 'Quantity'); }}
                {{ Form::text('Qty','1',
                    array(
                    'class'=>'form-control span3 txtbox-xs',
                    'placeholder'=>'',
                    'id'=>'qty',
                    'required'=>'required'
                    )) }}
                <br>
                {{ Form::label('', 'Product Image Upload'); }}
                @include('includes.file-upload.file-upload')
               </div>
               <br>
            </div>
                <center><input class="btn btn-success btn-lg txtbox-s" type="Submit"  id="SubmitButton" value="Start My Auction" /></center>
        </div>
    </div>
    {{ Form::close() }}
</div>