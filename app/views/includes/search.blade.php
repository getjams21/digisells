<div class="col-md-3 refine-search" style="border-radius:6px;">
	<div class="panel panel-primary" style="border-radius:6px;">
		<div class="panel-heading">
			<h4>Refine Search</h4>
		</div>
		<div class="panel-body" style="border-radius:6px;">
		{{ Form::open(['method'=>'GET','id'=>'refineSearch']) }}
			<div class="form-group">
		     <div class="input-group">
		       <div class="input-group-addon">Event:</div>
		        <select class="form-control" id="searchTypes">
				  <option value="/auction-listings" >Auction</option>
				  <option value="/direct-selling-listings">Direct Selling</option>
			    </select>
		     </div>
			</div>
			<i style="color:black;">
			{{ Form::label('Category', 'Select Category'); }}</i>
			{{ Form::select('Category',$category,
			    Input::old('Category'),
			    array('class'=>'form-control sqaure','id'=>'selectCategory')) }}
			    <br>
			 <i style="color:black;">
		 	{{ Form::label('SCategory', 'Select SubCategory'); }}</i>
		    {{ Form::select('SubCategory',
		        $subCategories,
		        null,
		        array('class'=>'form-control sqaure', 'id'=>'subCategory')) }}<br>
			<div class="form-group">
		     <div class="input-group">
		       <div class="input-group-addon">Price Range:</div>
		        <select class="form-control" name="price">
				  <option value="1">$1 - $50</option>
				  <option value="2">$50 - $100</option>
				  <option value="3">$100 - $500</option>
				  <option value="4">$500 - $1000</option>
				  <option value="5">$1000 - above</option>
			    </select>
		     </div>
			</div>
			 <div class="form-group input-group">
	            <input type="text" name="q" class="form-control">
	            <span class="input-group-btn">
	                <button class="btn btn-primary" type="submit" >Search
	                </button>
	            </span>
	        </div>
		{{ Form::close() }}
		</div>
	</div>
</div>