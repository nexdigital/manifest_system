<div id="page-wrapper">
	<div class="col-lg-6" style="padding:0px 10px 0px 0px;"> 
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-warning fa-fw"></i> Deadline on 7 days later
            </div>
            <div class="panel-body panel-body-modified" style="padding:0px; margin:0px;">
            	<div class="list-group" style="height:500px; overflow:auto; x-overflow:none; y-overflow:scroll;">
                    <?php
                        if($deadline) {
                            foreach ($deadline as $row) {
                                echo '
                                    <div class="list-group-item">
                                        <table>
                                            <tr>
                                                <td>Hawb No:</td><td>'.$row->hawb_no.'</td>
                                            </tr>
                                            <tr><td>Consginee Name:</td><td>'.$this->customers_model->get_by_id($row->consignee)->name.'</td>
                                            </tr>
                                            <tr>
                                                <td>Airwaybill:</td><td>IDR '.number_format($this->manifest_model->sub_total($row->hawb_no)).'</td>
                                            </tr>
                                            <tr>
                                                <td>Upload / Deadline:</td><td>'.$row->created_date.' / '.$row->deadline.'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" style="height:40px;">
                                                    <div class="btn-group pull-right">
                                                      <button type="button" class="btn btn-default btn-sm" onCLick="gotopage(\''.base_url().'customers/detail/'.$row->consignee.'\')">View Consignee</button>
                                                      <button type="button" class="btn btn-default btn-sm" onClick="view_manifest(\''.$row->hawb_no.'\')">View Manifest</button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                ';      
                            }
                        }
                    ?>
                </div>
                <?php if($deadline) echo '<p class="text-center">You have '.count($deadline).' customer(s) deadline</p>'; else echo '<p class="text-center">No have data</p>'; ?>
            </div>
        </div>
	</div>
	<div class="col-lg-6" style="padding:0px 0px 0px 10px;"> 
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-tasks fa-fw"></i> New Manifest Uploaded need Approval
            </div>
            <div class="panel-body panel-body-modified" style="padding:0px; margin:0px;">
            	<div class="list-group" style="height:500px; overflow:auto; x-overflow:none; y-overflow:scroll;">
                    <?php
            			if($manifest) {
                			foreach ($manifest as $row) {
                				$manifest_details = $this->manifest_model->get_by_file_id($row->file_id);
                				echo '
                                    <div class="list-group-item">
                                        <table>
                                            <tr>
                                                <td>Filename:</td><td>'.$manifest_details->file_name.'</td>
                                            </tr>
                                            <tr><td>Mawb No:</td><td>'.$manifest_details->mawb_no.'</td>
                                            </tr>
                                            <tr>
                                                <td>Upload Date:</td><td>'.$manifest_details->created_date.'</td>
                                            </tr>
                                            <tr>
                                                <td>Upload By:</td><td>'.$manifest_details->username.'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" style="height:40px;">
                                                    <div class="btn-group pull-right">
                                                      <button type="button" class="btn btn-warning btn-sm" onCLick="gotopage(\''.base_url().'/manifest/verification?file_id='.$manifest_details->file_id.'\')">Go to verification page</button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                				';		
                			}
                		}
            		?>
                </div>
                <?php if($manifest) echo '<p class="text-center">You have '.count($manifest).' new upload files</p>'; else echo '<p class="text-center">No have data</p>'; ?>
            </div>
        </div>
	</div>	
</div>

<script type="text/javascript">
function view_manifest(hawb_no){
    $.colorbox({
        iframe:true,
        href:'<?=base_url()?>manifest/modal/details?hawb_no='+hawb_no,
        width:'1100',
        height:'600',
        overlayClose:true,
        scrolling:true
    })
}
</script>