<div class="col-md-12">
	<center>
		<br>
		<h2><span>List your Product to Sell</span></h2>
		<div class="product-listing-step-2">
		</div>
	</center>
</div>
	<br>
<div class="jumbotron jmb-prop step-2">
    <div class="container">
    {{ Form::open(['route'=>['direct-selling',$step]]) }}
        <div class="col-md-10 col-md-offset-1">
            <center><h4>Tell us about your Selling Information</h4></center>
            <br>
            <hr class="style-fade">
        </div>
        <div class="col-md-10 col-md-offset-1">
            <div class="col-md-6 col-md-offset-3 product-listing">
                {{ Form::label('', 'Selling Name'); }}
                {{ Form::text('sellingName','',
                    array(
                    'class'=>'form-control span3',
                    'placeholder'=>'Selling Title/Name',
                    'id'=>'sellingName',
                    'required'=>'required'
                    )) }}
                <br>
                {{ Form::label('', 'Product Price'); }}
                <div class="input-group">
                    <span class="input-group-addon">$</span>
                    {{ Form::text('price','',
                    array(
                        'class'=>'form-control span3',
                        'placeholder'=>'How much is this?',
                        'id'=>'productPrice',
                        'required'=>'required'
                    )) }}
                </div>
                <br>
                {{ Form::label('', 'Discount Percentage (optional)'); }}
                <div class="input-group">
                    {{ Form::text('discount','',
                    array(
                        'class'=>'form-control span3',
                        'placeholder'=>'Discount',
                        'id'=>'discountPrice'
                    )) }}
                    <span class="input-group-addon">%</span>
                </div>
               <br>
               {{ Form::label('', 'Affiliate Percentage (optional)'); }}
               <div class="input-group">
                    {{ Form::text('affiliatePercentage','',
                    array(
                        'class'=>'form-control span3',
                        'placeholder'=>'Commission',
                        'id'=>'affiliatePercentage'
                    )) }}
                    <span class="input-group-addon">%</span>
                </div>
                <br>
                <center>
                    <button type="button" class='btn btn-primary btn-lg' id='btn-step-1'><span class='glyphicon glyphicon-arrow-left'></span></button>
                    <button type="submit" class='btn btn-primary btn-lg' id='btn-step-3'><span class='glyphicon glyphicon-arrow-right'></span></button>
                </center>
                {{ Form::open() }}
            </div>
        </div>
    </div>
</div>