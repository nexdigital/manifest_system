<?php
$shipper = $this->customers_model->get_by_id($data->shipper);
$shipper = '<a href="javascript:;" onCLick="parent.window.location=\''.base_url().'customers/detail/'.$shipper->reference_id.'\'">'.$shipper->name.'</a><br/>
'.$shipper->address.'
'.$shipper->country;

$consignee = $this->customers_model->get_by_id($data->consignee);
$consignee = '<a href="javascript:;" onCLick="parent.window.location=\''.base_url().'customers/detail/'.$consignee->reference_id.'\'">'.$consignee->name.'</a><br/>
'.$consignee->address.'
'.$consignee->country;
?>

<nav class="navbar navbar-default navbar-fixed-top text-left" role="navigation" style="padding:0px 20px;">
	<a class="navbar-brand" href="#">Details Data</a>
</nav>

<nav class="navbar navbar-default navbar-fixed-bottom text-right" role="navigation" style="padding:0px 10px;">
    <button type="button" class="btn btn-sm btn-primary navbar-btn" onCLick="window.location='<?=base_url()?>manifest/modal/extra_charge?hawb_no=<?=$data->hawb_no;?>'">Add Extra Charge</button>
    <button type="button" class="btn btn-sm btn-primary navbar-btn" onCLick="window.location='<?=base_url()?>manifest/modal/edit?hawb_no=<?=$data->hawb_no;?>'">Edit data</button>
    <button type="button" class="btn btn-sm btn-primary navbar-btn" onClick="print('<?=$data->hawb_no?>')">Print</button>
    <button type="button" class="btn btn-sm btn-danger navbar-btn" onClick="parent.$.colorbox.close();">Close</button>
</nav>

<div id="wrapper" style="padding:20px; margin-top:40px; margin-bottom:30px; background-color:#fff;">
	<div class="row">
	    <div class="col-sm-6">
	        <div class="form-group">
	            <label>Hawb No</label>
	            <input class="form-control" type="text" value="<?=$data->hawb_no;?>" readonly>
	        </div>
	    </div>
	    <div class="col-sm-2">
	    	<div class="form-group">
	            <label>Pkg</label>
	            <input class="form-control" type="text" value="<?=$data->pkg;?>" readonly>
	        </div>
	    </div>
	    <div class="col-sm-2">
	    	<div class="form-group">
	            <label>Pcs</label>
	            <input class="form-control" type="text" value="<?=$data->pcs;?>" readonly>
	        </div>
	    </div>
	    <div class="col-sm-2">
	    	<div class="form-group">
	            <label>KG</label>
	            <input class="form-control" type="text" value="<?=$data->kg;?>" readonly>
	        </div>
	    </div>
	    <div class="col-sm-6">
	    	<div class="form-group">
		    	<label>Shipper</label>
		        <p class="help-block"><?=ucfirst($shipper);?></p>
		    </div>
	    	<div class="form-group">
	    		<label>Consignee</label>
		        <p class="help-block"><?=ucfirst($consignee);?></p>
	    	</div>
	     	<div class="form-group">
		    	<label>Description</label>
		        <textarea class="form-control" rows="3" style="resize:none;" readonly><?=ucfirst($data->description);?></textarea>
		    </div>
	    </div>
        

	    <div class="col-sm-2">
	    	<div class="form-group">
	            <label>Value</label>
	            <input class="form-control" type="text" value="<?=$data->value;?>" readonly>
	        </div>
	    </div>
	    <div class="col-sm-2">
	    	<div class="form-group">
	            <label>Prepaid</label>
	            <input class="form-control" type="text" value="<?=$data->prepaid;?>" readonly>
	        </div>
	    </div>
	    <div class="col-sm-2">
	    	<div class="form-group">
	            <label>Collect</label>
	            <input class="form-control" type="text" value="<?=$data->collect;?>" readonly>
	        </div>
	    </div>
	    <div class="col-sm-2">
	    	<div class="form-group">
	            <label>Rate</label>
	            <input class="form-control" type="text" value="<?=$data->rate;?>" readonly>
	        </div>
	    </div>
	    <div class="col-sm-2">
	     	<div class="form-group">
		    	<label>Other Charge Tata</label>
		        <input class="form-control" type="text" value="<?=$data->other_charge_tata;?>" readonly>
		    </div>
	    </div>
	   	<div class="col-sm-2">
	     	<div class="form-group">
		    	<label>Other Charge PML</label>
		        <input class="form-control" type="text" value="<?=$data->other_charge_pml;?>" readonly>
		    </div>
	    </div>
	   	<div class="col-sm-6">
			<div class="form-group">
				<label>Remarks</label>
				<textarea class="form-control" rows="3" style="resize:none;" readonly><?=ucfirst($data->remarks);?></textarea>
			</div>
		</div>
	</div>
	<?php if($extra_charge != FALSE) { ?>
	<table  class="table table-striped table-bordered table-hover">
        <thead>	
            <tr>
                <th>Type</th>
                <th>Description</th>
                <th>Price</th>
                <th>Created</th>
                <th>User</th>
            </tr>
        </thead>
        <tbody>
        	<?php
    			foreach ($extra_charge as $row) {
        			echo '
        			<tr>
        				<td>'.$row->type.'</td>
        				<td>'.$row->description.'</td>
        				<td>'.$row->price.'</td>
        				<td>'.$row->created_date.'</td>
        				<td>'.$this->user_model->get_by_id($row->user_id)->username.'</td>
        			';

    			}
        	?>
        </tbody>
    </table>
    <?php } ?>	
</div>

<script type="text/javascript">
function print(hawb_no) {
    window.location = '<?=base_url()?>manifest/print_priview/'+hawb_no;
    //window.open('<?=base_url()?>download/pdf?hawb_no=' + hawb_no,'_blank');
}
</script>