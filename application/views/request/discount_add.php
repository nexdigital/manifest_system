<?php
$shipper = $this->customers_model->get_by_id($data->shipper);
$shipper = $shipper->name.'
'.$shipper->address.'
'.$shipper->country;

$consignee = $this->customers_model->get_by_id($data->consignee);
$consignee = $consignee->name.'
'.$consignee->address.'
'.$consignee->country;
?>

<div id="page-wrapper">
    <div class="panel panel-default panel-discount">
        <div class="panel-heading">
            Add Discount
        </div>
        <div class="panel-body">
        	<form id="form_add_discount" method="post" action="<?=base_url()?>manifest/ajax/discount?type=add">
                <div class="col-sm-6">
                    <div class="form-group" style="margin-top: -7px;">
                        <label>Hawb No</label>
                        <input class="form-control" type="text" name="hawb_no" value="<?=$data->hawb_no;?>">
                        <input class="form-control" type="hidden" name="data_id" value="<?=$data->data_id;?>">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Shipper</label>
                        <textarea class="form-control" rows="4" style="resize:none;" readonly><?=ucfirst($shipper);?></textarea>
                    </div>
                </div>
                <div class="col-sm-6" style="padding:0px; margin-top:-80px;">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Pkg</label>
                            <input class="form-control" type="text" name="pkg" value="<?=$data->pkg;?>">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Pcs</label>
                            <input class="form-control" type="text" name="pcs" value="<?=$data->pcs;?>">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>KG</label>
                            <input class="form-control" type="text" name="kg" value="<?=$data->kg;?>">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Value</label>
                            <input class="form-control" type="text" name="value" value="<?=$data->value;?>">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Prepaid</label>
                            <input class="form-control" type="text" name="prepaid" value="<?=$data->prepaid;?>">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Collect</label>
                            <input class="form-control" type="text" name="collect" value="<?=$data->collect;?>">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Rate</label>
                            <input class="form-control" type="text" name="rate" value="<?=$data->rate;?>">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Other Charge Tata</label>
                            <input class="form-control" type="text" name="other_charge_tata" value="<?=$data->other_charge_tata;?>">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Other Charge PML</label>
                            <input class="form-control" type="text" name="other_charge_pml" value="<?=$data->other_charge_pml;?>">
                        </div>
                    </div>

                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Consignee</label>
                        <textarea class="form-control" rows="4" style="resize:none;" readonly><?=ucfirst($consignee);?></textarea>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" rows="3" name="description" style="resize:none;"><?=ucfirst($data->description);?></textarea>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Remarks</label>
                        <textarea class="form-control" rows="3" name="remarks" style="resize:none;"><?=ucfirst($data->remarks);?></textarea>
                    </div>
                </div>


            	<div class="col-lg-6">
            		<div class="form-group">
            			<label>Type Discount</label>
            			<select class="form-control type-discount" name="type_discount">
            				<option value="rate">Rate</option>
                            <option value="kurs">Kurs</option>
            				<option value="total">Total</option>
            			</select>
            		</div>
            	</div>
            	<div class="col-lg-6">
            		<div class="form-group">
            			<label>Discount</label>
            			<input type="text" class="form-control" name="discount" required>
            		</div>
            	</div>
   	    		<div class="col-lg-12">
       	    		<button type="submit" class="btn btn-primary btn-sm" style="margin-bottom:15px;">Add Discount</button>
       	    	</div>
			</form>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function(){
    $('.type-discount').select2();

    $('#form_add_discount').validate();
    $('#form_add_discount').ajaxForm({
        dataType:'json',
        success:function(data){
            if(data.status == 'false') {
                alert(data.message);
            } else {
                window.location = data.redirect;
            }
        }
    });
})
</script>