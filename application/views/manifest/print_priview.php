<style type="text/css">
	p[contenteditable=true] {
		border:1px solid #ccc;
		padding: 10px;
	}
</style>
<?php
$print_priview_id = time();

$shipper = $this->customers_model->get_by_id($data->shipper);
$shipper = $shipper->name.'<br/>
'.$shipper->address.'
'.$shipper->country.' '.$shipper->post_code.'<br/>
Phone: '.$shipper->phone.' - Mobile: '.$shipper->mobile.'<br/>
Attn: '.$shipper->sort_name;

$consignee = $this->customers_model->get_by_id($data->consignee);
$consignee = $consignee->name.'<br/>
'.$consignee->address.'
'.$consignee->country.' '.$consignee->post_code.'<br/>
Phone: '.$consignee->phone.' - Mobile: '.$consignee->mobile.'<br/>
Attn: '.$consignee->sort_name;
?>

<nav class="navbar navbar-default navbar-fixed-top text-left" role="navigation" style="padding:0px 20px;">
	<a class="navbar-brand" href="#">Print Priview</a>
</nav>

<nav class="navbar navbar-default navbar-fixed-bottom text-right" role="navigation" style="padding:0px 10px;">
    <button type="button" class="btn btn-sm btn-primary navbar-btn" onClick="print('<?php echo $print_priview_id?>')">Print</button>
    <button type="button" class="btn btn-sm btn-danger navbar-btn" onClick="parent.$.colorbox.close();">Close</button>
</nav>

<div id="wrapper" style="padding:20px; margin-top:40px; margin-bottom:30px; background-color:#fff;">
	<div class="row">
	    <div class="col-sm-6">
	        <div class="form-group">
	            <label>Hawb No</label>
	            <p class="help-block hawb_no" contenteditable="false"><?php echo $data->hawb_no;?></p>
	        </div>
	    </div>
	    <div class="col-sm-6">
	    	<div class="form-group">
	            <label>Pkg</label>
	            <p class="help-block pkg" contenteditable="true"><?php echo $data->pkg;?></p>
	        </div>
	    </div>
	    <div class="col-sm-6">
	    	<div class="form-group">
		    	<label>Shipper</label>
		        <p class="help-block shipper" contenteditable="true"><?php echo ucfirst($shipper);?></p>
		    </div>
	    	<div class="form-group">
	    		<label>Consignee</label>
		        <p class="help-block consignee" contenteditable="true"><?php echo ucfirst($consignee);?></p>
	    	</div>
	    	<div class="form-group">
	    		<label>Description</label>
		        <p class="help-block description" contenteditable="true">&nbsp;<?php echo ucfirst($data->description . '<br/>' .$data->remarks);?></p>
	    	</div>
	    </div>
	    <div class="col-sm-6">
	    	<div class="form-group">
	            <label>KG</label>
	            <p class="help-block kg" contenteditable="true"><?php echo $data->kg;?></p>
	        </div>
	    </div>
	    <div class="col-sm-6">
	    	<div class="form-group">
	            <label>Rate/KG</label>
	            <select class="form-control rate_kurs">
		            <option value="NT" selected="selected">NT</option>
		            <option value="USD">USD</option>
	            </select>
	            <p class="help-block rate" contenteditable="true"><?php echo $data->rate;?></p>
	        </div>
	    </div>
	    <div class="col-sm-6">
	    	<div class="form-group">
	            <label>Exchange Rate</label>
	            <p class="help-block kurs" contenteditable="true"><?php echo $data->nt_kurs;?></p>
	        </div>
	    </div>
	    <div class="col-sm-6">
	    	<div class="form-group">
	            <label>Show Total? <em style="font-size:10px; color:#ff0000;">Type <?php echo ($data->collect) ? 'Collect' : 'Prepaid' ?></em></label>
	            <select class="form-control" id="show-total">
	            	<option value="true" <?php echo ($data->collect) ? 'selected="selected"' : '' ?>>Show</option>
	            	<option value="false" <?php echo ($data->prepaid) ? 'selected="selected"' : '' ?>>None</option>
	            </select>
	        </div>
	    </div>
	</div>	
</div>

<script type="text/javascript">
var print_priview_id = '<?php echo $print_priview_id?>';
$(document).ready(function(){
	save();

	$('p.help-block').blur(function(){
		save();
	})

	$('select#show-total').change(function(){
		save();
	})
})

function save(){
	var hawb_no 	= $('p.hawb_no').html();
	var shipper 	= $('p.shipper').html();
	var consignee 	= $('p.consignee').html();
	var description = $('p.description').html();
	var pkg 		= $('p.pkg').html();
	var kg 			= $('p.kg').html();
	var kurs 		= $('p.kurs').html();
	var rate_kurs 	= $('select.rate_kurs').val();
	var rate 		= $('p.rate').html();
	var show_total	= $('select#show-total').val();
	$.ajax({
		url:'<?php echo base_url()?>manifest/ajax/save_print_priview',
		type:'POST',
		data:{'print_priview_id':print_priview_id,'hawb_no':hawb_no,'shipper':shipper,'consignee':consignee,'description':description,'description':description,'pkg':pkg,'kg':kg,'kurs':kurs,'rate_kurs':rate_kurs,'rate':rate, 'show_total':show_total},
		dataType:'json',
		success:function(data){}
	})
}

function print(print_id) {
    window.open('<?php echo base_url()?>download/pdf?print_id=' + print_id,'_blank');
}
</script>