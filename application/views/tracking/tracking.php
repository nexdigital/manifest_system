<div id="wrapper">
	<div id="page-wrapper">
		<form id="tracking" method="get" action="<?=base_url()?>tracking/search">
		<div class="col-lg-12">
	        <div class="form-group">
		        <label>Search Hawb No</label>
		        <input class="form-control" type="text" name="hawb" required>
		    </div>
		</div>
		<div class="col-lg-3">
	        <div class="form-group">
		        <label>&nbsp;</label>
		        <button class="form-control btn-primary" type="submit">Search</button>
		    </div>
		</div>
		</form>
		<div class="col-lg-12 container-tracking"></div>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function(){
	$('#tracking').validate();
	$('#tracking').ajaxForm({
		success:function(data){
			$('.container-tracking').html(data);
		}
	})
})
</script>