
<div class="col-md-12">
		<center>
			<br>
			<h2><span>List your Product to Sell</span></h2>
			<div class="product-listing-steps">
			</div>
		</center>
	</div>
	<br>
	<div class="jumbotron jmb-prop step-1">
		<div class="container">
		{{ Form::open(['route'=>['direct-selling',$step]]) }}
		<div class="col-md-10 col-md-offset-1">
			<center><h4>Tell us about your Product</h4></center>
			<br>
			<hr class="style-fade">
			<br>
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
		<div class="col-md-10 col-md-offset-1">
			<br>
			<br>
			<hr class="style-fade">
			<div class="col-md-6 col-md-offset-3 product-listing">
				{{ Form::label('', 'Product Name'); }}
			    {{ Form::text('productName','',
			        array(
			        'class'=>'form-control span3',
			        'placeholder'=>'Product Name',
			        'id'=>'productName',
			        'required'=>'required'
			        )) }}
			    <br>
			    {{ Form::label('', 'Product Description'); }}
			    {{ Form::textarea('productDescription','',
			        array(
			        'class'=>'form-control span3',
			        'placeholder'=>'Describe your product',
			        'id'=>'productDesc',
			        'required'=>'required'
			    )) }}
			   <br>
			   {{ Form::label('', 'Product Quantity'); }}
			    {{ Form::text('quantity','',
			        array(
			        'class'=>'form-control span3',
			        'placeholder'=>'Product Quantity',
			        'id'=>'qty',
			        'required'=>'required'
			  	)) }}
			    <br>
			    <center><button type="submit" class='btn btn-primary btn-lg' id="to-step-2"><span class='glyphicon glyphicon-arrow-right'></span></button>

<!-- 			    <div class="panel error-panel square">
				    <span class="glyphicon glyphicon-warning-sign error-sign">&nbsp</span><span class="error-msg">Sample text</span>
				</div> -->
			    {{ Form::close() }}
				</center>
			</div>
		</div>
</div>
</div>