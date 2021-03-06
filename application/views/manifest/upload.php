<style type="text/css">
.tab-pane {
    padding: 10px 20px;
    border-left: 1px solid #e2e2e2;
    border-right: 1px solid #e2e2e2;
    border-bottom: 1px solid #e2e2e2;
}
</style>

<div id="page-wrapper">
    <ul class="nav nav-tabs" role="tablist" id="request_tab">
      <li role="presentation" class="active"><a href="#tab-import" role="tab" data-toggle="tab">Import</a></li>
      <li role="presentation"><a href="#tab-export" role="tab" data-toggle="tab">Single Item</a></li>
    </ul>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade active in" id="tab-import">
            <form id="form_upload_manifest" method="post" action="<?=site_url('manifest/ajax/upload')?>">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Mawb No</label>
                        <input class="form-control" name="mawb_no" required>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Consign To</label>
                        <input class="form-control" name="consign_to" required>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Flight No</label>
                        <input class="form-control" name="flight_no" required>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Gross Weight</label>
                        <input class="form-control" name="gross_weight" required>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Partner</label>
                        <select class="form-control flight_from" name="partner_id" required>
                            <?php
                                if($partner_list) {
                                    foreach ($partner_list as $row) {
                                        echo '<option value="'.$row->partner_id.'">'.$row->company_name.'</option>';
                                    }
                                }
                            ?>          
                        </select>
                        <?php if($partner_list==false) echo '<label class="error" for="flight_from">Please add first the partner.</label>'; ?>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>From</label>
                        <select class="form-control flight_from" name="flight_from" required>
                            <?php
                                foreach ($this->customers_model->list_country() as $key => $value) {
                                    $selected = (strtolower($value) == 'indonesia') ? 'selected' : '';
                                    echo '<option value="'.$value.'" '.$selected.'>'.$value.'</option>';
                                }
                            ?>          
                        </select>                                     
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>To</label>
                        <select class="form-control flight_to" name="flight_to" required>
                            <?php
                                foreach ($this->customers_model->list_country() as $key => $value) {
                                    $selected = (strtolower($value) == 'indonesia') ? 'selected' : '';
                                    echo '<option value="'.$value.'" '.$selected.'>'.$value.'</option>';
                                }
                            ?>
                        </select>                                  
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <input id="fileupload" type="file" name="userfile" required>
                    </div>
                    <input type="hidden" name="manifest_type" value="import">
                    <button type="submit" class="btn btn-success btn-sm submit-upload">Upload</button>
                </div>
            </div>
            </form>
        </div>

        <div role="tabpane1" class="tab-pane fade in" id="tab-export">
            <form method="post" action="<?=base_url()?>manifest/ajax/insert" id="form_upload_manifest_single">
            <div class="row">
                <div class="col-lg-12" style="padding:0px;">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Upload Type</label>
                            <select class="form-control upload_type" name="manifest_type" required>
                                <option value="">Select</option>
                                <option value="import">Import</option>
                                <option value="export">Export</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Hawb No</label>
                            <input class="form-control hawb_no" type="text" name="hawb_no" id="hawb_no_field" required>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12" style="padding:0px;">
                    <div class="col-lg-6" style="padding:0px;">
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>Pkg</label>
                                <input class="form-control text-pkg" type="text" name="pkg" required>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>Pcs</label>
                                <input class="form-control text-pcs" type="text" name="pcs" required>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>Value</label>
                                <input class="form-control text-value" type="text" name="value" required>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>KG</label>
                                <input class="form-control text-kg" type="text" name="kg" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Rate/KG</label>
                                <input class="form-control text-rate" type="text" name="rate" required>
                            </div>
                        </div>
                    </div>
                   	<div class="col-lg-6" style="padding:0px;">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="form-group">
                                    <label>Currency</label>
                                    <select class="form-control select-currency" name="currency" required>
                                        <option value="">Select</option>
                                        <?php
                                            foreach($list_currency as $row) {
                                                echo '<option value="'.$row->currency_name.'" currency_value="'.$row->currency_name.'">'.$row->currency_name.'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Exchange Rate</label>
                                <input class="form-control text-exchange-rate" type="text" name="exchange_rate" readonly required>
                            </div>
                        </div>
                   		<div class="col-sm-3">
                            <div class="form-group">
                                <label>Type Payment</label>
                                <select class="form-control" id="select-payment" name="type_payment" required>
	                                <option value="">Select</option>
	                                <option value="prepaid">Prepaid</option>
	                                <option value="collect">Collect</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Amount</label>
                                <input class="form-control text-amount" type="text" name="amount" readonly required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12" style="padding:0px;">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Shipper</label>
                            <p class="selected-shipper-text"></p>
                            <input type="hidden" name="shipper" class="selected-shipper" required>
                            <button type="button" class="btn btn-default btn-xs submit-upload select-customer" data_type="shipper">Select shipper</button>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Consignee</label>
                            <p class="selected-consignee-text"></p>
                            <input type="hidden" name="consignee" class="selected-consignee" required>
                            <button type="button" class="btn btn-default btn-xs submit-upload select-customer" data_type="consignee">Select consignee</button>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" rows="2" name="description" style="resize:none;"></textarea>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Remarks</label>
                        <textarea class="form-control" rows="2" name="remarks" style="resize:none;"></textarea>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Other Charge Tata</label>
                        <input class="form-control text-charge-tata" type="text" name="other_charge_tata">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Other Charge PML</label>
                        <input class="form-control text-charge-pml" type="text" name="other_charge_pml">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Subtotal</label>
                        <p class="form-control text-right text-subtotal" style="font-weight:bold; font-style:italic; background-color:#ccc;"></p>
                    </div>
                </div>
                <div class="col-lg-12">
                    <button type="submit" class="btn btn-success btn-sm submit-upload-other">Save</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="upload_progress_modal" class="colorbox-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="progress progress-striped active">
          <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%"></div>
        </div>
        <div class="progress-message" style="text-align:center;"></div>
      </div>
    </div>
  </div>
</div>

<div id="select_customer_modal" class="colorbox-modal colorbox-style" style="width:100%;">
    <div class="colorbox-header">
        <span class="customer-type"></span>
        <div class="pull-right"><a href="javascript:;" onCLick="$.colorbox.close();"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></div>
    </div>
    <div class="colorbox-body">
        <form id="search-customer">
        <div class="form-group">
            <label>Search Customer</label>
            <input type="hidden" class="type-search-customer">
            <input class="form-control" type="text" class="search-customer" onkeydown="search_customer(this)">
            <span class="text-search-customer"><span>
        </div>
        </form>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Name</th>
                    <th width="400px;">Address</th>
                    <th width="100px;">Country</th>
                    <th width="70px;">Select</th>
                </tr>
            </thead>
            <tbody class="result-search-customer"></tbody>
        </table>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function(){
    $('#form_upload_manifest, #form_upload_manifest_single').resetForm();	


	$('#form_upload_manifest').validate();
    $('#form_upload_manifest').ajaxForm({
        beforeSubmit: function() {
            $.colorbox({
                inline:true,
                href:$('#upload_progress_modal'),
                overlayClose:false
            })
        },
        dataType: 'json',
        success: function(data) {
            if(data.status == 'error') {
                $.colorbox.close();
                setTimeout(function(){
                    $.alertbeck({
                      title: 'Upload Manifest!',
                      content: data.message
                    });
                }, 1000)
            } else {
                $('#form_upload_manifest').resetForm();
                $.colorbox.close();
                setTimeout(function(){
                    $.alertbeck({
                      title: 'Upload Manifest!',
                      content: data.message
                    });
                }, 1000)
            }
        }
    })
    
    $('#form_upload_manifest_single .upload_type').change(function(){
        var type = $(this).val();
        switch(type) {
            case 'import':
                document.getElementById("hawb_no_field").readOnly = false;
                $('#form_upload_manifest_single .hawb_no').val('').focus();
                break;
            default:
                document.getElementById("hawb_no_field").readOnly = true;
                $.get('<?php echo base_url() ?>manifest/ajax/get_new_hawbno',function(data){                
                    $('#form_upload_manifest_single .hawb_no').val(data);
                })
                break;
        }
    })

    $('#form_upload_manifest_single .select-currency').change(function(){
        var currency_name = $(this).val();
        if(currency_name.length > 0) {
            $.post('<?php echo base_url()?>api/get_currency_value',{'currency_name':currency_name,'currency_type':'kurs transaction'},function(data){
                $('input.text-exchange-rate').val(data);
                $('p.text-subtotal').html(data);
            })
        } else {
            $('input.text-exchange-rate').val('');            
            $('p.text-subtotal').html('');
        }
    })

    $('#form_upload_manifest_single input, #form_upload_manifest_single select, #form_upload_manifest_single textarea').blur(function(){
        calc_subtotal();
    })

    $('#form_upload_manifest_single').validate();
    $('#form_upload_manifest_single').ajaxForm({
        dataType:'json',
        success:function(data){
            if(data.status == 'success') {
                $.alertbeck({
                  title: 'Upload Manifest!',
                  content: 'Upload data success'
                });
                $('#form_upload_manifest_single').resetForm();
                $('.selected-shipper-text, .selected-consignee-text').html('');
            } else {
                $.alertbeck({
                  title: 'Upload Manifest!',
                  content: data.message
                });
            }
        }
    });

    $('button.select-search-customer').live('click',function(){
        cust_id = $(this).attr('cust_id');
        data_type = $(this).attr('data_type');

        $.post('<?=base_url()?>customers/ajax/get_customer',{'cust_id':cust_id},function(data){
            data = JSON.parse(data);
            $('.selected-'+data_type+'-text').html(data.name + '<br/>' + data.address + '<br/>' + data.country);  
            $('.selected-'+data_type).val(data.reference_id);
            $('.result-search-customer').html();
            $.colorbox.close();
        })
    })

    $('button.select-customer').click(function(){
        $('.result-search-customer').html('');
        $('.text-search-customer').html('');

        var type = $(this).attr('data_type');
        $('.type-search-customer').val(type);
        $('.search-customer').val('');
        $('.text-search-customer').html('');
        $('.customer-type').text('Select ' + type);
        $('#search-customer').resetForm();
        $.colorbox({
            inline:true,
            href: $('#select_customer_modal'),
            width: 800,
            height:400,
            scrolling:true,
        })
    })
})

function search_customer(t) {
    t = t.value.trim();
    if(t.length > 0) {
        $('.text-search-customer').html('Searching...');
        $.post('<?=base_url()?>customers/ajax/search_customer',{'keyword': t, 'type':$('.type-search-customer').val()}, function(data){
            if(data == 0) {
                $('.text-search-customer').html('No Customers found!');
                $('.result-search-customer').html('');
            } else {
                $('.result-search-customer').html(data);
                $('.text-search-customer').html('');
            }
        })
    } else {
        $('.result-search-customer').html('');
        $('.text-search-customer').html('');
    }
}

function calc_subtotal(){
    var pkg         = $('input.text-pkg').val();
    var kg          = $('input.text-kg').val();
    var rate        = $('input.text-rate').val();
    var kurs        = $('input.text-exchange-rate').val();
    var charge_tata = $('input.text-charge-tata').val();
    var charge_pml  = $('input.text-charge-pml').val();

    $.post('<?=base_url()?>manifest/formula/subtotal',{'pkg':pkg,'kg':kg,'rate':rate,'kurs':kurs,'charge_tata':charge_tata,'charge_pml':charge_pml},function(data){
        data = JSON.parse(data);
        $('.text-amount').val(number_format(data.amount));
        $('p.text-subtotal').html('IDR ' + number_format(data.subtotal));
    })
}
</script>