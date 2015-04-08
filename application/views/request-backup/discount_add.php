<div id="wrapper">
    <div id="page-wrapper">
    	<div class="row">
            <div class="panel panel-default panel-discount">
                <div class="panel-heading">
                    Add Discount
                </div>
                <div class="panel-body">
                	<form id="form_add_discount" method="post" action="<?=base_url()?>manifest/ajax/discount?type=add">
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

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Hawb No</label>
                                <input class="form-control" name="hawb_no" type="text" value="<?=$data->hawb_no;?>" disabled>
                                <input class="form-control" name="hawb_no" type="hidden" value="<?=$data->hawb_no;?>">
                                <input class="form-control" name="data_id" type="hidden" value="<?=$data->data_id;?>">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Rate</label>
                                <input class="form-control" name="nt_kurs" type="text" value="<?=$data->nt_kurs;?>" disabled>
                                <input class="form-control" name="nt_kurs" type="hidden" value="<?=$data->nt_kurs;?>">
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>Pkg</label>
                                <input class="form-control" name="pkg" type="text" value="<?=$data->pkg;?>" disabled>
                                <input class="form-control" name="pkg" type="hidden" value="<?=$data->pkg;?>">
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>Pcs</label>
                                <input class="form-control" name="pcs" type="text" value="<?=$data->pcs;?>" disabled>
                                <input class="form-control" name="pcs" type="hidden" value="<?=$data->pcs;?>">
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>KG</label>
                                <input class="form-control" name="kg" type="text" value="<?=$data->kg;?>" disabled>
                                <input class="form-control" name="kg" type="hidden" value="<?=$data->kg;?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Shipper</label>
                                <textarea class="form-control" rows="3" disabled><?=ucfirst(trim($shipper));?></textarea>
                                <input  name="shipper" type="hidden" value="<?=$data->shipper?>">
                            </div>
                            <div class="form-group">
                                <label>Consignee</label>
                                <textarea class="form-control" rows="3" disabled><?=ucfirst(trim($shipper));?></textarea>
                                <input  name="consignee" type="hidden" value="<?=$data->consignee?>">
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>Value</label>
                                <input class="form-control" name="value" type="text" value="<?=$data->value;?>" disabled>
                                <input class="form-control" name="value" type="hidden" value="<?=$data->value;?>">
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>Prepaid</label>
                                <input class="form-control" name="prepaid" type="text" value="<?=$data->prepaid;?>" disabled>
                                <input class="form-control" name="prepaid" type="hidden" value="<?=$data->prepaid;?>">
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>Collect</label>
                                <input class="form-control" name="collect" type="text" value="<?=$data->collect;?>" disabled>
                                <input class="form-control" name="collect" type="hidden" value="<?=$data->collect;?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" name="description" rows="3" disabled><?=ucfirst($data->description);?></textarea>
                                <input class="form-control" name="description" type="hidden" value="<?=$data->description;?>">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Other Charge Tata</label>
                                <input class="form-control" name="other_charge_tata" type="text" value="<?=$data->other_charge_tata;?>" disabled>
                                <input class="form-control" name="other_charge_tata" type="hidden" value="<?=$data->other_charge_tata;?>">
                            </div>
                        </div>
                            <div class="col-sm-3">
                            <div class="form-group">
                                <label>Other Charge PML</label>
                                <input class="form-control" name="other_charge_pml" type="text" value="<?=$data->other_charge_pml;?>" disabled>
                                <input class="form-control" name="other_charge_pml" type="hidden" value="<?=$data->other_charge_pml;?>">
                            </div>
                        </div>


	                	<div class="col-lg-6">
	                		<div class="form-group">
	                			<label>Type Discount</label>
	                			<select class="form-control type-discount" name="type_discount">
	                				<option value="rate">Rate</option>
	                				<option value="value">Value</option>
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