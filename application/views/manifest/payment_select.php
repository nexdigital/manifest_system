<div id="wrapper">
	<div id="page-wrapper">
		<div class="col-lg-12">
	        <div class="form-group">
		        <label>Search Hawb No</label>
		        <input class="form-control" type="text" class="search-hawb" onkeyup="search_hawb(this)">
		    </div>
		    <table class="table table-hover table-search-hawb" style="display:none;">
		        <thead>
		            <tr>
		                <th>Hawb No</th>
		                <th width="75px;">Select</th>
		            </tr>
		        </thead>
		        <tbody class="result-search-hawb"></tbody>
		    </table>
		</div>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function(){
	$('button.select-search-customer').live('click',function(){
        data_id = $(this).attr('data_id');
        window.location = '<?=base_url()?>manifest/payment/add?data_id=' + data_id;
    })
})


function search_hawb(t) {
    if(t.value.length > 0) {
        $.post('<?=base_url()?>manifest/ajax/search_hawb',{'keyword': t.value, 'type':$('.type-search-customer').val()}, function(data){
            if(data == 0) { 
		    	$('.result-search-hawb').html(''); 
		    	$('.table-search-hawb').fadeOut();
            } else { 
            	$('.result-search-hawb').html(data); 
            	$('.table-search-hawb').fadeIn();
            }
        })
    } else { 
    	$('.result-search-hawb').html(''); 
    	$('.table-search-hawb').fadeOut();
    }
}
</script>