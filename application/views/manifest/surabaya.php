
<script type="text/javascript" charset="utf-8">
        $(document).ready(function() {

          $('#example').dataTable();
          $('#example1').dataTable();
             $('#reservation').daterangepicker();
             $('#reservation2').daterangepicker();

          });

    </script>

    <style>
    <style>

.col-xs-6 {

float: right;
text-align: right;
position: relative;

}

    </style>


<div class="wrapper">
    <div id="page-wrapper">


<div class="container" style="width: 100%">
    <div class="row">
		<div class="col-md-12">


			<div class="tabbable-panel">
				<div class="tabbable-line">
					<ul class="nav nav-tabs ">
						<li class="active">
							<a href="#tab_default_1" data-toggle="tab">
							Import </a>
						</li>
						<li>
							<a href="#tab_default_2" data-toggle="tab">
							Export </a>
						</li>

					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="tab_default_1">
                            <h4></h4>


                             <div class="table-responsive" style="overflow-y: auto">
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
                                                          <th style="width: 200px">Remarks</th>
                                                          <th style="width: 100px">Verification Date</th>

                                                      </tr>
                                                  </thead>

                                                     <tbody class="manifest-data-row">
                                                  <?php

                                                       if($get_surabaya_import != "") {
                                                          foreach ($get_surabaya_import as $key => $row) {
                                                              $shipper = $this->customers_model->get_by_id($row->shipper);
                                                              $consignee = $this->customers_model->get_by_id($row->consignee);
                                                              echo '
                                                              <tr id="' . $row->data_id.'">
                                                                <td class="data_no"><button type="button" class="btn btn-success btn-xs" id="show_info" data_id="'.$row->data_id.'" hawb_no ="'.$row->hawb_no.'" shipper="'.$shipper->name.'"  consignee="'.$consignee->name.'" pkg="'.$row->pkg.'" description="'.$row->description.'" pcs="'.$row->pcs.'" kg="'.$row->kg.'" value="'.$row->value.'" pp="'.$row->prepaid.'" cc="'.$row->collect.'" remarks="'.$row->remarks.'">Select</button></td>
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
                                                                 $date = $row->created_date;
                                                                 $date = date("d-F-Y", strtotime($date));
                                                              echo '
                                                                  <td align="center" class="pkg">'.$row->pkg.'</td>
                                                                  <td class="description">'.$row->description.'</td>
                                                                  <td align="center" class="pcs">'.$row->pcs.'</td>
                                                                  <td align="center" class="kg">'.$row->kg.'</td>
                                                                  <td align="center" class="value">'.$row->value.'</td>
                                                                  <td align="center" class="prepaid">'.$row->prepaid.'</td>
                                                                  <td align="center" class="collect">'.$row->collect.'</td>
                                                                  <td class="remarks">'.$row->remarks.'</td>
                                                                  <td class="remarks">'.$date.'</td>


                                                              ';

                                                            }

                                                          }

                                                  ?>
                                              </tbody>
                                          </table>
                                 </div>
						</div>





						<div class="tab-pane" id="tab_default_2">
                         <h4></h4>
							<div class="table-responsive" style="overflow-y: hidden;width: 100%;">
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
                                                          <th style="width: 200px">Remarks</th>
                                                          <th style="width: 100px">Verification Date</th>

                                                      </tr>
                                                  </thead>

                                                     <tbody class="manifest-data-row">
                                                  <?php

                                                        if($get_surabaya_export>0) {
                                                          foreach ($get_surabaya_export as $key => $row) {
                                                              $shipper = $this->customers_model->get_by_id($row->shipper);
                                                              $consignee = $this->customers_model->get_by_id($row->consignee);
                                                              echo '
                                                              <tr id="' . $row->data_id.'">
                                                                <td class="data_no"><button type="button" class="btn btn-success btn-xs" id="show_info" data_id="'.$row->data_id.'" hawb_no ="'.$row->hawb_no.'" shipper="'.$shipper->name.'"  consignee="'.$consignee->name.'" pkg="'.$row->pkg.'" description="'.$row->description.'" pcs="'.$row->pcs.'" kg="'.$row->kg.'" value="'.$row->value.'" pp="'.$row->prepaid.'" cc="'.$row->collect.'" remarks="'.$row->remarks.'">Select</button></td>
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
                                                                 $date = $row->created_date;
                                                                 $date = date("d-F-Y", strtotime($date));
                                                              echo '
                                                                  <td align="center" class="pkg">'.$row->pkg.'</td>
                                                                  <td class="description">'.$row->description.'</td>
                                                                  <td align="center" class="pcs">'.$row->pcs.'</td>
                                                                  <td align="center" class="kg">'.$row->kg.'</td>
                                                                  <td align="center" class="value">'.$row->value.'</td>
                                                                  <td align="center" class="prepaid">'.$row->prepaid.'</td>
                                                                  <td align="center" class="collect">'.$row->collect.'</td>
                                                                  <td class="remarks">'.$row->remarks.'</td>
                                                                  <td class="remarks">'.$date.'</td>


                                                              ';

                                                          }
                                                        }

                                                  ?>
                                              </tbody>
                                          </table>
                                 </div>
						</div>

                             <div class="container">
                                        	<div class="row">
                                                <div id="filter-panel" class="collapse filter-panel">
                                                    <div class="panel panel-default">
                                                        <div class="panel-body">

                                                        <form method="post">
                                                              <div class="form-group" style="width:50%;">
                                                                    <label>Date range:</label>

                                                                          <div class="input-group">
                                                                              <div class="input-group-addon">
                                                                                  <i class="fa fa-calendar"></i>
                                                                              </div>
                                                                              <input type="text" class="form-control pull-right" id="reservation" name="date" readonly />

                                                                          </div><!-- /.input group -->

                                                                      </div>

                                                                <div class="form-group">
                                                                      <input type="submit"  class="btn btn-success filter-col" name="find" value="find">
                                                                </div>

                                                        </form>
                                                        </div>
                                                    </div>
                                                </div>


                                                <form method="post">
                                                 <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#filter-panel">
                                                    <span class="glyphicon glyphicon-cog"></span> Advanced Search
                                                </button>
                                                <!--    <input type="submit" class="btn btn-default" value="Download excel" name="download">  -->
                                                </form>
                                        	</div>
                                        </div>

					</div>
				</div>
			</div>

         </div>
    </div>
</div>






      </div>
</div>

   <!--Modal info -->
<div class="modal fade " id="info_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
 <form method="post" action="<?php echo base_url()?>customers/ajax/cancel_bill" id="form_Unpaid">
 <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Info</h4>
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

    </div>

  </div>
     </form>
  </div>


 <script type="text/javascript">
  $(document).ready(function(){
 	$('#show_info').click(function(){
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



        $('#info_modal').modal('show');
    });

 });
 </script>
