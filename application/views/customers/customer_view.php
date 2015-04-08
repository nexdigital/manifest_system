<script type="text/javascript" charset="utf-8">
        $(document).ready(function() {
          $('#example').dataTable();
           $('#example1').dataTable();
          });

    </script>
<style>

.user-row {
    margin-bottom: 14px;
}

.user-row:last-child {
    margin-bottom: 0;
}

.dropdown-user {
    margin: 13px 0;
    padding: 5px;
    height: 100%;
}

.dropdown-user:hover {
    cursor: pointer;
}

.table-user-information > tbody > tr {
    border-top: 1px solid rgb(221, 221, 221);
}

.table-user-information > tbody > tr:first-child {
    border-top: 0;
}


.table-user-information > tbody > tr > td {
    border-top: 0;
}
.toppad
{margin-top:20px;
}

.table-responsive {
width: 100%;
margin-bottom: 15px;
overflow-y: hidden;
-ms-overflow-style: -ms-autohiding-scrollbar;

}
table {
  table-layout: fixed;
}

.col-xs-6 {

float: right;
text-align: right;
position: relative;

}

</style>

<div class="wrapper">
    <div id="page-wrapper">


        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >


          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title"><?= $customer_data->name?></h3>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=100" class="img-circle"> </div>

                <!--<div class="col-xs-10 col-sm-10 hidden-md hidden-lg"> <br>
                  <dl>
                    <dt>DEPARTMENT:</dt>
                    <dd>Administrator</dd>
                    <dt>HIRE DATE</dt>
                    <dd>11/12/2013</dd>
                    <dt>DATE OF BIRTH</dt>
                       <dd>11/12/2013</dd>
                    <dt>GENDER</dt>
                    <dd>Male</dd>
                  </dl>
                </div>-->

                <div class=" col-md-9 col-lg-9 ">
   <form method="post">
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td>Sort Name:</td>
                        <td><?= $customer_data->sort_name ?></td>
                      </tr>
                      <tr>
                        <td>Address</td>
                         <td><?= $customer_data->address ?></td>
                      </tr>
                      <tr>
                        <td>Status</td>
                        <td><?= $customer_data->status ?></td>
                      </tr>


                             <tr>
                        <td>Tax Class</td>
                        <?php if ($customer_data->tax_class >0 ){$tax_class = $customer_data->tax_class."%";}elseif($customer_data->tax_class== "none"){
							 $tax_class = $customer_data->tax_class;}else $tax_class="" ?>
                        <td><?= $tax_class ?></td>
                      </tr>

                      <tr>
                        <td>Email</td>

                        <td><a href="mailto:<?= $customer_data->email?>"><?= $customer_data->email?></a></td>
                      </tr>
					  <tr>
                        <td>Phone Number</td>
                        <?php if($customer_data->mobile != ""){
								$mobile = $customer_data->mobile."(mobile)";
							}else $mobile = ""?>
                        <td><?php echo $customer_data->phone."(Phone)" ?><br><br><?= $mobile?>
                        </td>

                      </tr>

					  <tr>
                        <td>Due Date Payment</td>
                        <?php if($customer_data->due_date_payment != "0000-00-00"){
								$duedate = $customer_data->due_date_payment;
							}elseif($customer_data->due_date_payment == "0000-00-00"){
								$duedate = "<div style='color:red'>not set </div>";
							}
							?>
                        <td><?php echo $duedate?><br><br>
                        </td>

                      </tr>

                    </tbody>
                  </table>

                  <?php if($customer_data->status == "regular"){
                 	echo "<input type='submit' name='unRegular' class='btn btn-primary' value='set Unregular customer'>";
				  }elseif($customer_data->status == ""){
					echo "<input type='submit' name='subRegular' class='btn btn-primary' value='make regular customer'>";
				  }
                    ?>
               </form>
                </div>
              </div>
            </div>
                 <div class="panel-footer">

                 <button class="btn btn-default btn-xs dropdown-toggle" type="button" data-toggle="modal" aria-expanded="false" data-target="#myModal">
                  <i class="glyphicon glyphicon-envelope"></i>
                  </button>



                        <span class="pull-right">
                           <?php  echo  "<a href='".base_url()."customers/edit/".$customer_data->reference_id."' data-original-title='Edit this user' data-toggle='tooltip' type='button' class='btn btn-sm btn-warning' name='edit'><i class='glyphicon glyphicon-edit'></i></a>
                           <a href='#' data-original-title='Remove this user' data-toggle='modal'  data-target='#confirm-delete' class='btn btn-sm btn-danger'><i class='glyphicon glyphicon-remove'></i></a>" ?>
                        </span>
                    </div>

          </div>

        </div>
                       <div class="table-responsive">
                       <h3>Paid</h3>
                           <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
                                <thead>
                                    <tr>
                                        <th width="50">Action</th>
                                        <th width="100">Flight No</th>
                                        <th width="100">Hawb No</th>
                                        <th style="width: 500px">Shipper</th>
                                        <th style="width: 500px">Consignee</th>
                                        <th style="width: 50px">PKG</th>
                                        <th style="width: 500px">Description</th>
                                        <th width="40">PCS</th>
                                        <th width="40">KG</th>
                                        <th width="40">Val</th>
                                        <th width="40">PP</th>
                                        <th width="40">CC</th>
                                        <th style="width: 500px">Remarks</th>

                                    </tr>
                                </thead>
                                <tbody class="manifest-data-row">
                                <?php
                                    if($customer_paid != false) {

                                        foreach ($customer_paid as $key => $row) {
                                            $shipper = $this->customers_model->get_by_id($row->shipper);
                                            $consignee = $this->customers_model->get_by_id($row->consignee);
                                            echo '
                                            <tr id="' . $row->data_id.'">
                                              <td class="data_no"><button type="button" class="btn btn-success btn-xs" id="show_payment_paid" data_id="'.$row->data_id.'" hawb_no ="'.$row->hawb_no.'" shipper="'.$shipper->name.'"  consignee="'.$consignee->name.'" pkg="'.$row->pkg.'" description="'.$row->description.'" pcs="'.$row->pcs.'" kg="'.$row->kg.'" value="'.$row->value.'" pp="'.$row->prepaid.'" cc="'.$row->collect.'" remarks="'.$row->remarks.'">Select</button></td>
                                                <td class="data_no">'.$row->data_no.'</td>
                                                <td class="hawb_no">'.$row->hawb_no.'</td>
                                            ';

                                            echo '<td class="shipper">';

                                            if($shipper != FALSE) {
                                                echo '
                                                    <strong>'.$shipper->name.'</strong><br/>
                                                    '.$shipper->address.'<br/>
                                                    '.$shipper->country;
                                            }
                                            echo '</td>';

                                            echo '<td class="consignee">';

                                            if($consignee != FALSE) {
                                                echo '
                                                    <strong>'.$consignee->name.'</strong><br/>
                                                    '.$consignee->address.'<br/>
                                                    '.$consignee->country;
                                            }
                                            echo '</td>';

                                            echo '
                                                <td align="center" class="pkg">'.$row->pkg.'</td>
                                                <td class="description">'.$row->description.'</td>
                                                <td align="center" class="pcs">'.$row->pcs.'</td>
                                                <td align="center" class="kg">'.$row->kg.'</td>
                                                <td align="center" class="value">'.$row->value.'</td>
                                                <td align="center" class="prepaid">'.$row->prepaid.'</td>
                                                <td align="center" class="collect">'.$row->collect.'</td>
                                                <td class="remarks">'.$row->remarks.'</td>


                                            ';

                                        }
                                    }
                                ?>
                            </tbody>
                        </table>
                        </div>

                         <div class="table-responsive">
                       <h3>Unpaid</h3>
                           <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example1">
                                <thead>
                                    <tr>
                                        <th width="50">Action</th>
                                        <th width="100">Flight No</th>
                                        <th width="100">Hawb No</th>
                                        <th style="width: 500px">Shipper</th>
                                        <th style="width: 500px">Consignee</th>
                                        <th style="width: 50px">PKG</th>
                                        <th style="width: 500px">Description</th>
                                        <th width="40">PCS</th>
                                        <th width="40">KG</th>
                                        <th width="40">Val</th>
                                        <th width="40">PP</th>
                                        <th width="40">CC</th>
                                        <th style="width: 500px">Remarks</th>

                                    </tr>
                                </thead>
                                <tbody class="manifest-data-row">
                                <?php
                                    if($customer_Unpaid != false) {

                                        foreach ($customer_Unpaid as $key => $row) {
                                            $shipper = $this->customers_model->get_by_id($row->shipper);
                                            $consignee = $this->customers_model->get_by_id($row->consignee);
                                            echo '
                                            <tr id="' . $row->data_id.'">
                                              <td class="data_no"><button type="button" class="btn btn-success btn-xs" id="show_payment" data_id="'.$row->data_id.'" hawb_no ="'.$row->hawb_no.'" shipper="'.$shipper->name.'"  consignee="'.$consignee->name.'" pkg="'.$row->pkg.'" description="'.$row->description.'" pcs="'.$row->pcs.'" kg="'.$row->kg.'" value="'.$row->value.'" pp="'.$row->prepaid.'" cc="'.$row->collect.'" remarks="'.$row->remarks.'">Select</button></td>
                                                <td class="data_no">'.$row->data_no.'</td>
                                                <td class="hawb_no">'.$row->hawb_no.'</td>
                                            ';

                                            echo '<td class="shipper">';

                                            if($shipper != FALSE) {
                                                echo '
                                                    <strong>'.$shipper->name.'</strong><br/>
                                                    '.$shipper->address.'<br/>
                                                    '.$shipper->country;
                                            }
                                            echo '</td>';

                                            echo '<td class="consignee">';

                                            if($consignee != FALSE) {
                                                echo '
                                                    <strong>'.$consignee->name.'</strong><br/>
                                                    '.$consignee->address.'<br/>
                                                    '.$consignee->country;
                                            }
                                            echo '</td>';

                                            echo '
                                                <td align="center" class="pkg">'.$row->pkg.'</td>
                                                <td class="description">'.$row->description.'</td>
                                                <td align="center" class="pcs">'.$row->pcs.'</td>
                                                <td align="center" class="kg">'.$row->kg.'</td>
                                                <td align="center" class="value">'.$row->value.'</td>
                                                <td align="center" class="prepaid">'.$row->prepaid.'</td>
                                                <td align="center" class="collect">'.$row->collect.'</td>
                                                <td class="remarks">'.$row->remarks.'</td>


                                            ';

                                        }
                                    }
                                ?>
                            </tbody>
                        </table>
                        </div>
      </div>




      </div>

   <!--Modal Message Email -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form action="<?php echo site_url('customers/ajax/send_email')?>" method="post" id="email_form">

  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Email Form</h4>
      </div>
      <div class="modal-body">
        <table>
              <tr>
                   <td>To: &nbsp</td>
                   <td><input name="to" type="text" value="<?= $customer_data->email?>" class="form-control" required></td>

              </tr>
               <tr>
                   <td>Message: &nbsp</td>
                   <td><textarea cols="50" style="resize: none" name="message" class="form-control" required>This Email is warning.Please pay your bill</textarea></td>

              </tr>

        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type ="submit"  class="btn btn-primary" value="Send Email" >

      </div>

    </div>
  </div>
  </form>
</div>



   <!-- Modal message email -->

      <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Confirmation
            </div>
            <div class="modal-body">
                Are You Sure Want To Delete This User?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a href="<?=base_url()?>customers/customer_delete/<?php echo $customer_data->reference_id ?>" class="btn btn-danger danger">Delete</a>
            </div>
        </div>






    </div>
</div>



<!-- Modal -->

<!-- Payment unpaid-->
 <div class="modal fade " id="payment_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
 <form method="post" action="<?php echo base_url()?>customers/ajax/payment_bill" id="form_paid">
 <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">repayment bill</h4>
      </div>
      <div class="modal-body">
        <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Hawb No</th>

                            <th class="text-center">Shipper</th>
                            <th class="text-center">Consignee</th>
                            <th class="text-center">PKG</th>
                            <th class="text-center" style="width: 85px">Description</th>
                            <th class="text-center">PCS</th>
                            <th class="text-center">KG</th>
                            <th class="text-center">VALUE</th>
                            <th class="text-center">PP</th>
                            <th class="text-center">CC</th>
                            <th class="text-center">Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                            <input type="hidden" class="data_id" name="data_id">
                     <tr>
                            <td class="col-md-9"><em><span class="hawb"> </span></em></td>
                            <td class="col-md-9 text-center"><span class="shipper"></span></td>
                            <td class="col-md-9 text-center"><span class="consignee"></span></td>
                            <td class="col-md-9 text-center"><span class="pkg"></span></td>
                            <td class="col-md-9 text-center"><span class="description"></span></td>
                            <td class="col-md-9 text-center"><span class="pcs"></span></td>
                            <td class="col-md-9 text-center"><span class="kg"></span></td>
                            <td class="col-md-9 text-center"><span class="val"></span></td>
                            <td class="col-md-9 text-center"><span class="pp"></span></td>
                            <td class="col-md-9 text-center"><span class="cc"></span></td>
                            <td class="col-md-9 text-center"><span class="remarks"></span></td>
                        </tr>

                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="text-right">
                            <p>
                                Subtotal:
                            </p>
                            <p>Tax:</p></td>
                            <td class="text-center">
                            <p>$6.94</p>
                            <p>$6.94</p></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="text-right"><h4>Total</h4></td>
                            <td class="text-center text-danger"><h4><strong>$31.53</strong></h4></td>
                        </tr>
                    </tbody>
                </table>

      </div>



      <center> <p class="message-update" style="padding:15px 15px; display:none;"></p></center>
      <div class="progress progress-striped active" style="display: none">
            <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
            </div>
        </div>
      <div class="modal-footer footer_paid">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary paid" value="Paid"/>
      </div>
    </div>

  </div>
     </form>
  </div>


<!-- //Payment_Unpaid-->


<!-- Payment paid-->
 <div class="modal fade " id="payment_paid_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
 <form method="post" action="<?php echo base_url()?>customers/ajax/cancel_bill" id="form_Unpaid">
 <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Cancel bill</h4>
      </div>
      <div class="modal-body">
        <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Hawb No</th>

                            <th class="text-center">Shipper</th>
                            <th class="text-center">Consignee</th>
                            <th class="text-center">PKG</th>
                            <th class="text-center" style="width: 85px">Description</th>
                            <th class="text-center">PCS</th>
                            <th class="text-center">KG</th>
                            <th class="text-center">VALUE</th>
                            <th class="text-center">PP</th>
                            <th class="text-center">CC</th>
                            <th class="text-center">Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                            <input type="hidden" class="data_id" name="data_id">
                     <tr>
                            <td class="col-md-9"><em><span class="hawb"> </span></em></td>
                            <td class="col-md-9 text-center"><span class="shipper"></span></td>
                            <td class="col-md-9 text-center"><span class="consignee"></span></td>
                            <td class="col-md-9 text-center"><span class="pkg"></span></td>
                            <td class="col-md-9 text-center"><span class="description"></span></td>
                            <td class="col-md-9 text-center"><span class="pcs"></span></td>
                            <td class="col-md-9 text-center"><span class="kg"></span></td>
                            <td class="col-md-9 text-center"><span class="val"></span></td>
                            <td class="col-md-9 text-center"><span class="pp"></span></td>
                            <td class="col-md-9 text-center"><span class="cc"></span></td>
                            <td class="col-md-9 text-center"><span class="remarks"></span></td>
                        </tr>

                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="text-right">
                            <p>
                                Subtotal:
                            </p>
                            <p>Tax:</p></td>
                            <td class="text-center">
                            <p>$6.94</p>
                            <p>$6.94</p></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="text-right"><h4>Total</h4></td>
                            <td class="text-center text-danger"><h4><strong>$31.53</strong></h4></td>
                        </tr>
                    </tbody>
                </table>

      </div>



      <center> <p class="message-update" style="padding:15px 15px; display:none;"></p></center>
      <div class="progress progress-striped active" style="display: none">
            <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
            </div>
        </div>
      <div class="modal-footer footer_paid">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary paid" value="Set To Unpaid"/>
      </div>
    </div>

  </div>
     </form>
  </div>


<!-- //Payment_paid-->


<script type="text/javascript">
$(document).ready(function(){


 	$('#show_payment').click(function(){

        data_id = $(this).attr('data_id');
        hawb_no = $(this).attr('hawb_no');
        shipper = $(this).attr('shipper');
        consignee = $(this).attr('consignee');
        pkg = $(this).attr('pkg');
        description = $(this).attr('description');
        pcs = $(this).attr('pcs');
        kg = $(this).attr('kg');
        value = $(this).attr('value');
        pp = $(this).attr('pp');
        cc = $(this).attr('cc');
        remarks = $(this).attr('remarks');
        $('.data_id').val(data_id);
        $('.hawb').html(hawb_no);
        $('.shipper').html(shipper);
        $('.consignee').html(consignee);
        $('.pkg').html(pkg);
        $('.description').html(description);
        $('.pcs').html(pcs);
        $('.kg').html(kg);
        $('.value').html(value);
        $('.pp').html(pp);
        $('.cc').html(cc);
        $('.remarks').html(remarks);

        $('#payment_modal').modal('show');

    })

    	$('#show_payment_paid').click(function(){

        data_id = $(this).attr('data_id');
        hawb_no = $(this).attr('hawb_no');
        shipper = $(this).attr('shipper');
        consignee = $(this).attr('consignee');
        pkg = $(this).attr('pkg');
        description = $(this).attr('description');
        pcs = $(this).attr('pcs');
        kg = $(this).attr('kg');
        value = $(this).attr('value');
        pp = $(this).attr('pp');
        cc = $(this).attr('cc');
        remarks = $(this).attr('remarks');
        $('.data_id').val(data_id);
        $('.hawb').html(hawb_no);
        $('.shipper').html(shipper);
        $('.consignee').html(consignee);
        $('.pkg').html(pkg);
        $('.description').html(description);
        $('.pcs').html(pcs);
        $('.kg').html(kg);
        $('.value').html(value);
        $('.pp').html(pp);
        $('.cc').html(cc);
        $('.remarks').html(remarks);
        $('#payment_paid_modal').modal('show');

    })

    $('.paid').click(function(){
       $('.progress-striped').fadeIn();

    })

     $('#form_paid').ajaxForm({
        dataType: 'json',
        success: function(data){

            if(data.status == true) {
                 $('.message-update').html(data.message).removeClass('bg-danger').addClass('bg-success').fadeIn();
                 $('.footer_paid').fadeOut();

                 setTimeout(function(){
                   $('#payment_modal').modal('hide');
                   location.reload();
                }, 3000);
            } else {

               $('.message-update').html(data.message).addClass('bg-danger').removeClass('bg-success').fadeIn();
                setTimeout(function(){
                    $('.message-update').fadeOut();
                }, 3000);

            }
        }
    })

      $('#form_Unpaid').ajaxForm({
        dataType: 'json',
        success: function(data){

            if(data.status == true) {
                 $('.message-update').html(data.message).removeClass('bg-danger').addClass('bg-success').fadeIn();
                 $('.footer_paid').fadeOut();

                 setTimeout(function(){
                   $('#payment_modal').modal('hide');
                   location.reload();
                }, 3000);
            } else {

               $('.message-update').html(data.message).addClass('bg-danger').removeClass('bg-success').fadeIn();
                setTimeout(function(){
                    $('.message-update').fadeOut();
                }, 3000);

            }
        }
    })


     $('#confirm-delete').onclick('show.bs.modal',function(e) {

     		$(this).find('.danger').attr('href', $(e.relatedTarget).data('href'));
    })



 });
</script>

<!-- Large modal -->
