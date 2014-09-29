
<div class="container">
	<div class="col-md-12">
	<br>
	<center>
		<h3>Put/Edit Additional Information for <font color="#428bca"><b>{{$product->productName}}</b></font></h3>
		<hr class="style-fade">
		{{ Form::model($product, ['method'=>'PATCH','route' => ['edit-details.update', $product->id]]) }}
			<textarea class="ckeditor" name="details"></textarea>
			<br>
			<button type="submit" class="btn btn-primary btn-lg" style="width:500px;">I'm done sire</button>
		{{ Form::close() }}
	</center>
	</div>
</div>