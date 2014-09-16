@extends('admin.master.layout')
@section('meta-title', 'Fund_Withdrawals')
@section('content')
<div class="row">
    <div class="col-md-12">
        @include('funds.includes.showWithdrawalPartial')
    </div><!-- /.col-lg-12 -->
</div>
@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        $("#print").click(function(){
			$("#Printable").printThis({
			     debug: false,             
			     importCSS: true,           
			     printContainer: true,       
			     loadCSS: "public/_/css/mystyle.css", 
			     pageTitle: "Digisells Invoice",              
			     removeInline: false,        
			     printDelay: 333,           
			     header: null,              
			     formValues: true            
	 		 });
		});
    });
</script>
@stop
@stop
