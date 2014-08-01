
<br>
<div class="container">
	<div class="col-md-12 offset-3">
        <h2>Start an Auction Event</h2>
		<hr class="style-shadowed">
	</div>
    {{ Form::open() }}
	<div class="col-md-12">
        <div class="col-md-6">
            {{ Form::label('Category', 'Select Category'); }}
            {{ Form::select('Category',
                array(
                    'Apps'=>'Apps/Softwares',
                    'Business'=>'Business/Marketing',
                    'Domains'=>'Domains/Websites',
                    'Music'=>'Music',
                    'WSO'=>'WSO'
                ),
                null,
                array('class'=>'form-control sqaure')) }}
        </div>
        <div class="col-md-6">
            {{ Form::label('SCategory', 'Select Sub Category'); }}
            {{ Form::select('SubCategory',
                array(
                    'Apps'=>'Apps/Softwares',
                    'Business'=>'Business/Marketing',
                    'Domains'=>'Domains/Websites',
                    'Music'=>'Music',
                    'WSO'=>'WSO'
                ),
                null,
                array('class'=>'form-control sqaure')) }}
        </div>
	</div>
    <div class="col-md-12">
        <br>
            <h4>Product and Event Information</h4>
        <hr class="style-fade">
    </div>
    <div class="col-md-12">
        <br>
        <div class="well brd-prop">
            <div class="col-md-6 left-padding">
                {{ Form::label('', 'Auction Name'); }}
                {{ Form::text('AuctionName','',
                    array(
                    'class'=>'form-control span3 txtbox-m',
                    'placeholder'=>'Name/Title of Auction'
                    )) }}
                <br>
                {{ Form::label('', 'Starting Price'); }}
                <div class="input-group txtbox-s">
                    <span class="input-group-addon">$</span>
                    {{ Form::text('MinimumPrice','',
                    array(
                        'class'=>'form-control span3',
                        'placeholder'=>'Starting Price',
                        'id'=>'MinimumPrice'
                    )) }}
                </div>
                <br>
                {{ Form::label('', 'Buyout Price'); }}
                <div class="input-group txtbox-s">
                    <span class="input-group-addon">$</span>
                    {{ Form::text('BuyoutPrice','',
                    array(
                        'class'=>'form-control span3',
                        'placeholder'=>'Buyout Price'
                    )) }}
                </div>
                <br>
                {{ Form::label('', 'Start Date'); }}
                <div class="form-group row">
                  <div class="col-xs-8">
                    <div class="input-group date txtbox-m" id="grp-startDate" data-date-format="mm-dd-yyyy">
                      <input class="form-control" id="startDate" type="text">
                      <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                    </div>
                  </div>
                </div>  
                {{ Form::label('', 'End Date'); }}
                <div class="form-group row">
                  <div class="col-xs-8">
                    <div class="input-group date txtbox-m" id="grp-endDate" data-date="" data-date-format="mm-dd-yyyy">
                      <input class="form-control" type="text" id="endDate">
                      <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                    </div>
                  </div>
                </div>
                {{ Form::label('', 'Incrementation Option'); }}
                <div class="input-group">
                    <div class="btn-group">
                      <button type="button" class="btn btn-primary" id="standard" data-container="body" data-toggle="popover" placement="left" data-content="Select Standard way of bidding incrementation rule. The minimum next bid will be the last bid price + its 5% or higher.">Standard</button>
                      <button type="button" class="btn btn-primary" id="customized">Customized</button>
                    </div>
                    <div class="well next-bid-info">
                        <center><p>First bid price must be:<b><br><span name='bidPrice' id='bid-price'></span><br></b>or Higher
                        </p></center>
                    </div>
                    <div class="alert alert-danger validateMinPrice" role="alert">
                        <p>Minimum Price must <br>NOT be '0' or EMPTY!</p>
                    </div>
                </div>
                
            </div>
            <div class="container">
               <div class="col-md-6">
                {{ Form::label('', 'Product Name'); }}
                {{ Form::text('ProductName','',
                    array(
                    'class'=>'form-control span3 txtbox-m',
                    'placeholder'=>'Name your product'
                    )) }}
                <br>
                {{ Form::label('', 'Product Description'); }}
                {{ Form::textarea('ProducteDescription','',
                    array(
                    'class'=>'form-control span3 txtbox-m',
                    'placeholder'=>'Describe your product'
                    )) }}
                <br>
                {{ Form::label('', 'Quantity'); }}
                {{ Form::text('Qty','',
                    array(
                    'class'=>'form-control span3 txtbox-xs',
                    'placeholder'=>'1'
                    )) }}
                <br>
            </div>
            </div>
        </div>
    </div>
    {{ Form::close() }}
</div>