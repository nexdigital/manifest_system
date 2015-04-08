<style type="text/css">
.tab-pane {
	padding: 10px 20px;
	border-left: 1px solid #e2e2e2;
	border-right: 1px solid #e2e2e2;
	border-bottom: 1px solid #e2e2e2;
}
</style>

<div id="wrapper">
    <div id="page-wrapper">
        <div class="row">
			<ul class="nav nav-tabs" role="tablist" id="request_tab">
			  <li role="presentation" class="active"><a href="#tab-dicount" role="tab" data-toggle="tab">Discount</a></li>
			  <li role="presentation"><a href="#profile" role="tab" data-toggle="tab">Profile</a></li>
			  <li role="presentation"><a href="#messages" role="tab" data-toggle="tab">Messages</a></li>
			  <li role="presentation"><a href="#settings" role="tab" data-toggle="tab">Settings</a></li>
			</ul>

			<div class="tab-content">
			  <div role="tabpanel" class="tab-pane fade active in" id="tab-dicount">
			  		<form id="form_upload_manifest" method="post" action="<?=site_url('manifest/ajax/upload')?>">
                    <div class="row">
                        <div class="col-lg-12">                            
                            <div class="form-group">
                                <label>Select Data</label>
                                <select class="form-control" name="data_id" id="select_data" required>
                                    <?php
                                        foreach ($manifest_data as $key => $row) {
                                            echo '<option value="'.$row->data_id.'">'.$row->data_id.'</option>';
                                        }
                                    ?>          
                                </select>                                     
                            </div>
                            <div class="form-group">
                                <label>Discount Price</label>
                                <input class="form-control" type="text" name="discount" required>
                            </div>
                            <button type="submit" class="btn btn-success btn-sm submit-upload">Submit <img src="<?=base_url('asset/images/ajax-loader.gif')?>" class="ajax-loader" style="margin-left:20px; display:none;"></button>
                        </div>
                    </div>
                    </form>
			  </div>
			  <div role="tabpanel" class="tab-pane fade in" id="profile">...</div>
			  <div role="tabpanel" class="tab-pane fade in" id="messages">...</div>
			  <div role="tabpanel" class="tab-pane fade in" id="settings">...</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function(){
	$('#select_data').select2();

	$('#request_tab a').click(function (e) {
	  e.preventDefault()
	  $(this).tab('show')
	})
})
</script>