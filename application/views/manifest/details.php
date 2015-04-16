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
    <div class="btn-group pull-right">
        <button type="button" class="btn btn-sm btn-default navbar-btn" onCLick="gotopage('<?=base_url()?>manifest/modal/extra_charge?hawb_no=<?=$data->hawb_no;?>')">Extra Charge</button>
        <button type="button" class="btn btn-sm btn-default navbar-btn" onCLick="gotopage('<?=base_url()?>manifest/modal/edit?hawb_no=<?=$data->hawb_no;?>')">Edit data</button>
        <button type="button" class="btn btn-sm btn-default navbar-btn" onCLick="gotopage('<?=base_url()?>manifest/modal/edit_invoice?hawb_no=<?=$data->hawb_no;?>')">Edit Invoice</button>
        <button type="button" class="btn btn-sm btn-default navbar-btn" onClick="gotopage('<?=base_url()?>download/pdf?hawb_no=<?=$data->hawb_no;?>','new')">Print</button>
        <button type="button" class="btn btn-sm btn-danger navbar-btn" onClick="parent.$.colorbox.close();">Close</button>
    </div>
</nav>

<div id="wrapper" style="padding:20px; margin-top:40px; margin-bottom:30px; background-color:#fff;">
	<div class="row">
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
                    <input class="form-control" type="text" value="<?=$data->hawb_no?>" readonly>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-sm-12 col-xs-12" style="padding:0px;">
            <div class="col-lg-6 col-sm-6 col-xs-6" style="padding:0px;">
                <div class="col-lg-2 col-sm-2 col-xs-2">
                    <div class="form-group">
                        <label>Pkg</label>
    	                <input class="form-control" type="text" value="<?=$data->pkg?>" readonly>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-2 col-xs-2">
                    <div class="form-group">
                        <label>Pcs</label>
	                    <input class="form-control" type="text" value="<?=$data->pcs?>" readonly>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-2 col-xs-2">
                    <div class="form-group">
                        <label>Value</label>
	                    <input class="form-control" type="text" value="<?=$data->value?>" readonly>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-2 col-xs-2">
                    <div class="form-group">
                        <label>KG</label>
	                    <input class="form-control" type="text" value="<?=$data->kg?>" readonly>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-4 col-xs-4">
                    <div class="form-group">
                        <label>Rate/KG</label>
	                    <input class="form-control" type="text" value="<?=$data->rate?>" readonly>
                    </div>
                </div>
            </div>
           	<div class="col-lg-6 col-sm-6 col-xs-6" style="padding:0px;">
                <div class="col-lg-3 col-sm-3 col-xs-3">
                    <div class="form-group">
                        <div class="form-group">
                            <label>Currency</label>
		                    <select class="form-control select-currency" name="currency" disabled>
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
	                    <input class="form-control" type="text" value="<?=$data->exchange_rate?>" readonly>
                    </div>
                </div>
           		<div class="col-lg-3 col-sm-3 col-xs-3">
                    <div class="form-group">
                        <label>Type Payment</label>
                        <select class="form-control" id="select-payment" name="type_payment" disabled="">
                            <option value="prepaid" <?php echo ($data->prepaid) ? 'selected="selected"' : ''; ?>>Prepaid</option>
                            <option value="collect" <?php echo ($data->collect) ? 'selected="selected"' : ''; ?>>Collect</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-3 col-xs-3">
                    <div class="form-group">
                        <label>Amount</label>
	                    <input class="form-control" type="text" value="<?php echo ($data->prepaid) ? number_format($data->prepaid) : number_format($data->collect) ?>" readonly>
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
                <textarea class="form-control" rows="2" name="description" style="resize:none;" readonly><?=$data->description?></textarea>
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <label>Remarks</label>
                <textarea class="form-control" rows="2" name="remarks" style="resize:none;" readonly><?=$data->remarks?></textarea>
            </div>
        </div>
        <div class="col-lg-3 col-sm-3 col-xs-3">
            <div class="form-group">
                <label>Other Charge Tata</label>
                <input class="form-control" type="text" value="<?=$data->other_charge_tata?>" readonly>
            </div>
        </div>
        <div class="col-lg-3 col-sm-3 col-xs-3">
            <div class="form-group">
                <label>Other Charge PML</label>
                <input class="form-control" type="text" value="<?=$data->other_charge_pml?>" readonly>
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <label>Subtotal</label>
                <p class="form-control text-right text-subtotal" style="font-weight:bold; font-style:italic;">IDR <?php echo number_format($this->manifest_model->sub_total($data->hawb_no))?></p>
            </div>
        </div>
    </div>

	<?php if($extra_charge != FALSE) { ?>
    <div class="col-lg-12 col-sm-12 col-xs-12 text-center">
    <h3>Extra Charge</h3>
    </div>
	<table class="table table-striped table-bordered table-hover">
        <thead> 
            <tr>
                <th>Type</th>
                <th>Description</th>
                <th>Currency</th>
                <th>Price</th>
                <th>Debit Note</th>
                <th>Created</th>
                <th>User</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if($extra_charge != FALSE) {
                    foreach ($extra_charge as $row) {
                        echo '
                        <tr>
                            <td>'.$row->charge_type.'</td>
                            <td>'.$row->description.'</td>
                            <td>'.$row->currency_name.'</td>
                            <td>'.number_format($row->currency_value).'</td>
                            <td>'.$row->sync_debit.'</td>
                            <td>'.substr($row->created_date,0,10).'</td>
                            <td>'.$this->user_model->get_by_id($row->user_id)->username.'</td>
                        ';

                    }
                }
            ?>
        </tbody>
    </table>
    <?php } ?>	
</div>