<?php
$shipper = $this->customers_model->get_by_id($data->shipper);
$consignee = $this->customers_model->get_by_id($data->consignee);
?>

<nav class="navbar navbar-default navbar-fixed-top text-left" role="navigation" style="padding:0px 20px;">
	<a class="navbar-brand" href="#">Edit Invoice</a>
</nav>

<nav class="navbar navbar-default navbar-fixed-bottom text-right" role="navigation" style="padding:0px 10px;">
    <div class="btn-group pull-right">
        <button type="button" class="btn btn-sm btn-default navbar-btn" id="update_invoice">Save</button>
        <button type="button" class="btn btn-sm btn-warning navbar-btn" onClick="gotopage('<?=base_url()?>manifest/modal/details?hawb_no=<?=$data->hawb_no;?>')">Back</button>
    </div>
</nav>

<div id="wrapper" style="padding:20px; margin-top:40px; margin-bottom:30px; background-color:#fff;">
	<div class="row">
		<form method="post" action="<?=base_url()?>manifest/ajax/update_invoice" id="update_invoice_form">
	    <div class="col-lg-12 col-sm-12 col-xs-12" style="padding:0px;">
            <div class="col-lg-6 col-sm-6 col-xs-6">
                <div class="form-group">
                    <label>Hawb No</label>
                    <input class="form-control" type="text" value="<?=$data->hawb_no?>" name="hawb_no" readonly>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-sm-12 col-xs-12" style="padding:0px;">
            <div class="col-lg-6 col-sm-6 col-xs-6" style="padding:0px;">
                <div class="col-lg-2 col-sm-2 col-xs-2">
                    <div class="form-group">
                        <label>Pkg</label>
    	                <input class="form-control" type="text" value="<?=$data->pkg?>" name="pkg" readonly required>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-2 col-xs-2">
                    <div class="form-group">
                        <label>Pcs</label>
	                    <input class="form-control" type="text" value="<?=$data->pcs?>" name="pcs" readonly required>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-2 col-xs-2">
                    <div class="form-group">
                        <label>Value</label>
	                    <input class="form-control" type="text" value="<?=$data->value?>" name="value" readonly required>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-2 col-xs-2">
                    <div class="form-group">
                        <label>KG</label>
	                    <input class="form-control" type="text" value="<?=$data->kg?>" name="kg" readonly required>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-4 col-xs-4">
                    <div class="form-group">
                        <label>Rate/KG</label>
	                    <input class="form-control" type="text" value="<?=$data->rate?>" name="rate" readonly required>
                    </div>
                </div>
            </div>
           	<div class="col-lg-6 col-sm-6 col-xs-6" style="padding:0px;">
                <div class="col-lg-3 col-sm-3 col-xs-3">
                    <div class="form-group">
                        <div class="form-group">
                            <label>Currency</label>
		                    <select class="form-control select-currency" name="currency" required>
                                <?php
                                    foreach($this->master->get_list_currency('Kurs Transaction') as $row) {
                                    	$selected = (strtolower($row->currency_name) == strtolower($data->currency)) ? 'selected="selected"' : 'disabled="disabled"';
                                        echo '<option value="'.$row->currency_name.'" '.$selected.'>'.$row->currency_name.'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-3 col-xs-3">
                    <div class="form-group">
                        <label>Exchange Rate</label>
	                    <input class="form-control" type="text" value="<?=$data->exchange_rate?>" name="exchange_rate" readonly required>
                    </div>
                </div>
           		<div class="col-lg-3 col-sm-3 col-xs-3">
                    <div class="form-group">
                        <label>Type Payment</label>
                        <select class="form-control" id="select-payment" name="type_payment" required>
                            <option value="prepaid" <?php echo ($data->prepaid) ? 'selected="selected"' : 'disabled="disabled"'; ?>>Prepaid</option>
                            <option value="collect" <?php echo ($data->collect) ? 'selected="selected"' : 'disabled="disabled"'; ?>>Collect</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-3 col-xs-3">
                    <div class="form-group">
                        <label>Amount</label>
	                    <input class="form-control" type="text" value="<?php echo ($data->prepaid) ? number_format($data->prepaid) : number_format($data->collect) ?>" name="amount" readonly required>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-sm-12 col-xs-12" style="padding:0px;">
            <div class="col-lg-6 col-sm-6 col-xs-6">
                <div class="form-group">
                    <label>Shipper</label>
	                <input class="form-control" type="text" value="<?=$shipper->name?>" name="shipper_name">
	                <textarea class="form-control" rows="2" name="shipper_details" style="height:100px; resize:none;"><?=trim(strtolower($shipper->address." ".$shipper->city." ".$shipper->country . "\nattn: ".$shipper->sort_name." Phone: ".$shipper->phone." Mobile: ".$shipper->mobile))?></textarea>
                </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-xs-6">
                <div class="form-group">
                    <label>Consignee</label>
	                <input class="form-control" type="text" value="<?=$consignee->name?>" name="consignee_name">
	                <textarea class="form-control" rows="2" name="consignee_details" style="height:100px; resize:none;"><?=trim(strtolower($consignee->address." ".$consignee->city." ".$consignee->country . "\nattn: ".$consignee->sort_name." Phone: ".$consignee->phone." Mobile: ".$consignee->mobile))?></textarea>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <label>Description & Remarks</label>
                <textarea class="form-control" rows="2" name="description" style="height:100px; resize:none;"><?=$data->description . "\n" .$data->remarks?></textarea>
            </div>
        </div>
		</form>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function(){
	$('#update_invoice').click(function(){
		$('#update_invoice_form').ajaxSubmit({
			dataType:'json',
			success:function(data){
				window.location = '<?=base_url()?>manifest/modal/details?hawb_no=' + data.hawb_no;
			}
		})
	})
})
</script>