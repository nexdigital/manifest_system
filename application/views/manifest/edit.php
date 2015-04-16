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
	<a class="navbar-brand" href="#">Edit Data</a>
</nav>

<nav class="navbar navbar-default navbar-fixed-bottom text-right" role="navigation" style="padding:0px 10px;">
    <div class="btn-group pull-right">
        <button type="button" class="btn btn-sm btn-default navbar-btn" id="manifest_update_btn">Save</button>
        <button type="button" class="btn btn-sm btn-warning navbar-btn" onClick="gotopage('<?=base_url()?>manifest/modal/details?hawb_no=<?=$data->hawb_no;?>')">Back</button>
    </div>
</nav>

<div id="wrapper" style="padding:20px; margin-top:40px; margin-bottom:30px; background-color:#fff;">
	<div class="row">
		<form method="post" action="<?=base_url()?>manifest/ajax/update" id="manifest_data_update">
		    <div class="col-lg-12 col-sm-12 col-xs-12" style="padding:0px;">
            <div class="col-lg-6 col-sm-6 col-xs-6">
                <div class="form-group">
                    <label>MAWB No</label>
                    <input class="form-control" type="text" value="<?=$data->mawb_no?>" readonly>
                </div>
            </div>
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
    	                <input class="form-control" type="text" value="<?=$data->pkg?>" name="pkg" required>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-2 col-xs-2">
                    <div class="form-group">
                        <label>Pcs</label>
	                    <input class="form-control" type="text" value="<?=$data->pcs?>" name="pcs" required>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-2 col-xs-2">
                    <div class="form-group">
                        <label>Value</label>
	                    <input class="form-control" type="text" value="<?=$data->value?>" name="value" required>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-2 col-xs-2">
                    <div class="form-group">
                        <label>KG</label>
	                    <input class="form-control" type="text" value="<?=$data->kg?>" name="kg" required>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-4 col-xs-4">
                    <div class="form-group">
                        <label>Rate/KG</label>
	                    <input class="form-control" type="text" value="<?=$data->rate?>" name="rate" required>
                    </div>
                </div>
            </div>
           	<div class="col-lg-6 col-sm-6 col-xs-6" style="padding:0px;">
                <div class="col-lg-3 col-sm-3 col-xs-3">
                    <div class="form-group">
                        <div class="form-group">
                            <label>Currency</label>
		                    <select class="form-control select-currency" name="currency" disabled required>
                                <?php
                                    foreach($this->master->get_list_currency('Kurs Transaction') as $row) {
                                    	$selected = (strtolower($row->currency_name) == strtolower($data->currency)) ? 'selected="selected"' : '';
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
                            <option value="prepaid" <?php echo ($data->prepaid) ? 'selected="selected"' : ''; ?>>Prepaid</option>
                            <option value="collect" <?php echo ($data->collect) ? 'selected="selected"' : ''; ?>>Collect</option>
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
                    <p class="selected-shipper-text"><?=$shipper?></p>
                </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-xs-6">
                <div class="form-group">
                    <label>Consignee</label>
                    <p class="selected-consignee-text"><?=$consignee?></p>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <label>Description</label>
                <textarea class="form-control" rows="2" name="description" style="resize:none;"><?=$data->description?></textarea>
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <label>Remarks</label>
                <textarea class="form-control" rows="2" name="remarks" style="resize:none;"><?=$data->remarks?></textarea>
            </div>
        </div>
        <div class="col-lg-3 col-sm-3 col-xs-3">
            <div class="form-group">
                <label>Other Charge Tata</label>
                <input class="form-control" type="text" value="<?=$data->other_charge_tata?>" name="charge_tata">
            </div>
        </div>
        <div class="col-lg-3 col-sm-3 col-xs-3">
            <div class="form-group">
                <label>Other Charge PML</label>
                <input class="form-control" type="text" value="<?=$data->other_charge_pml?>" name="charge_pml">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <label>Subtotal</label>
                <p class="form-control text-right text-subtotal" style="font-weight:bold; font-style:italic;">IDR <?php echo number_format($this->manifest_model->sub_total($data->hawb_no))?></p>
            </div>
        </div>
		</form>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function(){
	$('#manifest_update_btn').click(function(){
		$('#manifest_data_update').ajaxSubmit({
			dataType:'json',
			success:function(data){
				window.location = '<?=base_url()?>manifest/modal/details?hawb_no=' + data.hawb_no;
			}
		})
	})
})
</script>