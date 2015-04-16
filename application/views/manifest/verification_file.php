<div id="page-wrapper">
    <table id="dataTable" class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th width="100">Hawb No</th>
                <th>Shipper</th>
                <th>Consignee</th>
                <th width="100">Info Details</th>
                <th width="100">Description</th>
                <th width="100">Other Charge</th>
            </tr>
        </thead>
        <tbody class="manifest-data-row">
        <?php
            if($list_data != false) {
                $no = 1;
                foreach ($list_data as $key => $row) {
                    $check_valid_status = $this->manifest_model->check_valid_status($row->data_id);
                    switch ($check_valid_status) {
                        case '0': $status_class = ''; break;
                        case '1': $status_class = 'warning'; break;
                        case '2': $status_class = 'success'; break;
                        default: $status_class = ''; break;
                    }
                    echo '
                    <tr id="' . $row->data_id.'" class="'.$status_class.'">
                        <td class="hawb_no">'.$row->hawb_no.'</td>
                    ';

                    echo '<td class="shipper"><div style="border-bottom:1px solid #ccc; margin:5px 0px;">';
                    $shipper = $this->customers_model->get_by_id($row->shipper);
                    if($shipper != FALSE) {                                                
                        echo '
                            <strong>'.$shipper->name.'</strong><br/>
                            '.$shipper->address.'<br/>
                            '.$shipper->country;
                    } else {
                        echo $row->shipper;
                        $similar = $this->customers_model->check_speeling_address($row->shipper);
                        echo '</div><div class="btn-group">';
                        if($similar != FALSE) {
                            echo '
                                <button class="btn btn-xs btn-info show-similar" type="button" title="You have '.count($similar).' similar customer(s)" manifest_data_id="'.$row->data_id.'" data_type="shipper">
                                  Similar <span class="badge">'.count($similar).'</span>
                                </button>
                            ';
                        }
                        echo '
                        <button type="button" class="btn btn-xs btn-danger add-customer" title="Add as new customer" manifest_data_id="'.$row->data_id.'" data_type="shipper">
                            <span class="glyphicon glyphicon-plus"></span>
                        </button>
                        </div>';
                    }
                    echo '</td>';

                    echo '<td class="consignee"><div style="border-bottom:1px solid #ccc; margin:5px 0px;">';
                    $consignee = $this->customers_model->get_by_id($row->consignee);
                    if($consignee != FALSE) {                                                
                        echo '
                            <strong>'.$consignee->name.'</strong><br/>
                            '.$consignee->address.'<br/>
                            '.$consignee->country;
                    } else {
                        echo $row->consignee;
                        $similar = $this->customers_model->check_speeling_address($row->consignee);
                        echo '</div><div class="btn-group">';
                        if($similar != FALSE) {
                            echo '
                                <button class="btn btn-xs btn-info show-similar" type="button" title="You have '.count($similar).' similar customer(s)" manifest_data_id="'.$row->data_id.'" data_type="consignee">
                                  Similar <span class="badge">'.count($similar).'</span>
                                </button>
                            ';
                        }
                        echo '
                            <button class="btn btn-xs btn-danger add-customer" title="Add as new customer" manifest_data_id="'.$row->data_id.'" data_type="consignee">
                            <span class="glyphicon glyphicon-plus"></span>
                            </button>
                        </div>';
                    }
                    
                    echo '
                        <td align="left">
                            CC: '.$row->collect.'<br/>
                            PP: '.$row->prepaid.'<br/>
                            PKG: '.$row->pkg.'<br/>
                            PCS: '.$row->pcs.'<br/>
                            VALUE: '.$row->value.'<br/>
                        </td>
                        <td class="description">'.$row->description.'</td>
                        <td>
                            TATA: '.$row->other_charge_tata.'<br/>
                            PML: '.$row->other_charge_pml.'
                        </td>
                    </tr>
                    ';
                    $no++;
                }
            } else {
                echo '
                <tr>
                    <td colspan="13" align="center">No found data</td>
                </tr>
                ';
            }
        ?>
    </tbody>
    </table>
</div>

<div class="modal fade" id="modal_add_customer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form id="add_customer_modal" method="post" action="<?=base_url()?>customers/ajax/add_customer">
    <input type="hidden" class="form-control cust_id" name="cust_id" value="">
    <input type="hidden" class="form-control data_id" name="data_id" value="">
    <input type="hidden" class="form-control data_type" name="data_type" value="">

    <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close close-modal" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title">Add New Customer <span class="manifest-data-id"></span></h4>
          </div>
          <div class="modal-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-lg-12">
                        <div class="well well-sm alert-info" id="address_info"></div>
                        <div class="form-group">
                            <label>Refference Id</label>
                            <input type="text" class="form-control cust_id_" name="cust_id" value="" disabled>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">   
                            <label>Name</label>
                            <input type="text" class="form-control" name="cust_name" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">   
                            <label>Attn</label>
                            <input type="text" class="form-control" name="attn">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Address</label>
                            <textarea class="form-control" name="cust_address" required style="height:178px; resize:none;"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label >State</label>
                            <input id="state" name="cust_state" type="text" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>City</label>
                            <input id="city" name="cust_city" type="text" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Country</label>
                            <select class="form-control bfh-states country" name="cust_country">
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
                            <label>Email</label>
                            <input type="email" class="form-control" name="cust_email" required>
                        </div>                   
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">   
                            <label>Phone</label>
                            <input type="text" class="form-control" name="cust_phone" required>
                        </div>   
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Tax Class</label>
                            <select required class="form-control tax_class" name="tax_class">
                                <option value="0">None</option>
                                <option value="1">1%</option>
                                <option value="10">10%</option>
                            </select>
                        </div>
                    </div>  
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-default close-modal" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-sm btn-primary">Add customer</button>
          </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
    </form>
</div>

<div class="modal fade" id="modal_similar_customer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form id="add_customer_modal" method="post" action="<?=base_url()?>customers/ajax/add_customer">
    <input type="hidden" class="form-control cust_id" name="cust_id" value="">
    <input type="hidden" class="form-control data_id" name="data_id" value="">
    <input type="hidden" class="form-control data_type" name="data_type" value="">

    <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close close-modal" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title">Select Similar Customer</h4>
          </div>
          <div class="modal-body">
            <table id="dataSimilarCustomer" class="table table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>Country</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Select</th>
                    </tr>
                </thead>
                <tbody class="similar-customer-container"></tbody>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-default close-modal" data-dismiss="modal">Close</button>
          </div>
        </div>
    </div>
    </form>
</div>

<script type="text/javascript">
$(document).ready(function(){
    $('button.add-customer').click(function(){
        data_id = $(this).attr('manifest_data_id');
        data_type = $(this).attr('data_type');
        $.post('<?=base_url()?>customers/ajax/get_new_cust_id',function(data){
            $('input.cust_id, input.cust_id_').val(data);
        })

        $.post('<?=base_url()?>manifest/ajax/get_data',{'data_id':data_id},function(data){
            data = JSON.parse(data);
            $('.manifest-data-id').html('#' + data.hawb_no);
            if(data_type == 'shipper') $('.address-string').html(data_type + ': ' +data.shipper);
            if(data_type == 'consignee') $('.address-string').html(data_type + ': ' +data.consignee);
            
            $('input.data_id').val(data.data_id);
            $('input.data_type').val(data_type);
            if(data_type == 'shipper') $('#address_info').html('<strong>Shipper:</strong> <br/>' + data.shipper);
            if(data_type == 'consignee') $('#address_info').html('<strong>Consignee:</strong> <br/>' + data.consignee);
        })

        $('#modal_add_customer').modal('show');
        $('#add_customer_modal').resetForm();
    })

    $('#add_customer_modal').validate();
    $('#add_customer_modal').ajaxForm({
        dataType:'json',
        success: function(data){
            $('tr#' + data.data_id).removeClass('warning').addClass(data.status);
            $('tr#' + data.data_id).find('td.' + data.type).html(data.data);
            $('#modal_add_customer').modal('hide');
        }
    });

    $('.show-similar').click(function(){
        data_id = $(this).attr('manifest_data_id');
        data_type = $(this).attr('data_type');
        $.post('<?=base_url()?>customers/ajax/get_similar_customer',{'data_id':data_id,'type':data_type},function(data){
            $('tbody.similar-customer-container').html(data);
        })

        $('#modal_similar_customer').modal('show');
        $('table#dataSimilarCustomer').dataTable();
    })

    $('.select-similar-customer').live('click',function(){
        cust_id = $(this).attr('cust_id');
        data_id = $(this).attr('data_id');
        data_type = $(this).attr('data_type');

        $.post('<?=base_url()?>customers/ajax/set_customer_to_data',{'cust_id':cust_id,'data_id':data_id,'type':data_type},function(data){
            data = JSON.parse(data);
            $('tr#' + data.data_id).removeClass('warning').addClass(data.status);
            $('tr#' + data.data_id).find('td.' + data.type).html(data.data);
            $('#modal_similar_customer').modal('hide');
        })
    })
});
</script>