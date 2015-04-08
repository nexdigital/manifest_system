<nav class="navbar navbar-default navbar-fixed-top text-left" role="navigation" style="padding:0px 20px;">
	<a class="navbar-brand" href="#">Extra Charge #<?=$data->hawb_no?></a>
</nav>

<nav class="navbar navbar-default navbar-fixed-bottom text-right" role="navigation" style="padding:0px 10px;">
    <button type="button" class="btn btn-sm btn-primary navbar-btn" onCLick="window.location='<?=base_url()?>manifest/modal/details?hawb_no=<?=$data->hawb_no;?>'">Back</button>
</nav>

<div id="wrapper" style="padding:20px; margin-top:40px; margin-bottom:30px; background-color:#fff;">
	<div class="row">
	    <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Add Charge
                </div>
                <div class="panel-body">
                	<form id="form_extra_charge" method="post" action="<?=base_url()?>manifest/ajax/extra_charge?type=add">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Type</label>
                            <select class="form-control charge_type" name="type_charge">
                    			<option value="PIBK">PIBK</option>
                    			<option value="PDRI">PDRI</option>
                    			<option value="Other Charge">Other Charge</option>
                            </select>
                        </div>                                             
					</div>
					<div class="col-sm-2">
                        <div class="form-group">
                            <label>Description</label>
                            <input type="text" name="description" class="form-control" required/>
                        </div>                                             
					</div>
					<div class="col-sm-2">
                        <div class="form-group">
                            <label>Currency</label>
                            <select class="form-control charge_type" name="type_currency">
                    			<option value="idr">IDR</option>
                    			<option value="nt">NT</option>
                            </select>
                        </div>                                             
					</div>
					<div class="col-sm-2">
                        <div class="form-group">
                            <label>Price</label>
                            <input type="number" name="price" class="form-control" required/>
                        </div>                                             
					</div>
					<div class="col-sm-2">
                        <div class="checkbox" style="margin-top:25px;">
						    <label>
						      <input type="checkbox" name="sync_debit"> Sync Snow
						    </label>
						</div>                                            
					</div>
					<div class="col-sm-1">
                        <div class="form-group">
                        	<label>&nbsp;</label>
                            <button type="submit" class="btn btn-sm btn-default form-control submit-form">Add</button>
                            <input type="hidden" name="data_id" value="<?=$data->data_id?>">
                        </div>                                             
					</div>
					</form>
				</div>
			</div>

			<table  class="table table-striped table-bordered table-hover">
	            <thead>	
	                <tr>
	                    <th>Type</th>
	                    <th>Description</th>
	                    <th>Currency</th>
	                    <th>Price</th>
	                    <th>Debit Note</th>
	                    <th>Created</th>
	                    <th>User</th>
	                    <th align="center" width="85px">Action</th>
	                </tr>
	            </thead>
	            <tbody>
	            	<?php
	            		if($extra_charge != FALSE) {
	            			foreach ($extra_charge as $row) {
		            			echo '
		            			<tr>
		            				<td>'.$row->type.'</td>
		            				<td>'.$row->description.'</td>
		            				<td>'.$row->currency.'</td>
		            				<td>'.number_format($row->price).'</td>
		            				<td>'.$row->sync_debit.'</td>
		            				<td>'.substr($row->created_date,0,10).'</td>
		            				<td>'.$this->user_model->get_by_id($row->user_id)->username.'</td>
		            				<td>
		            					<div class="btn-group btn-group-xs">
					                        <button type="button" class="btn btn-default" title="Delete" id="delete_charge" charge_id="'.$row->charge_id.'"><span class="glyphicon glyphicon-remove"></span></button>
					                    </div>
		            				</td>
	    	        			';

	            			}
	            		} else echo '<tr><td colspan="6" class="text-center">No have any charge</td></tr>';
	            	?>
	            </tbody>
	        </table>
		</div>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function(){
	$('.charge_type').select2();
	
	$('#form_extra_charge').validate();
	$('#form_extra_charge').ajaxForm({
		dataType:'json',
		success:function(data){
			if(data.status == 'false') {
				alert(data.message);
			} else {
				$('#form_extra_charge').resetForm();
				alert('Extra charge added');
				location.reload();
			}
		}
	})

	$('button#delete_charge').click(function(){
		confirm = confirm('Are you sure will remove the charge?');

		if(confirm) {
			charge_id = $(this).attr('charge_id');
			$.post('<?=base_url()?>manifest/ajax/extra_charge?type=delete',{'charge_id':charge_id,function(){
				location.reload();
			}})
		} else {
			location.reload();
		}
	})
})
</script>