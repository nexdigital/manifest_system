<style type="text/css">
.panel-body-modified {
	height: 400px;
    overflow-x: none;
    overflow-y: scroll;   
}
.list-group-item:first-child {
	border-top-left-radius: 0px;
    border-top-right-radius: 0px;
}
.list-group-item:last-child {
    border-bottom-left-radius: 0px;
    border-bottom-right-radius: 0px;
    margin-bottom: 0;
}
</style>

<div id="wrapper">
    <div id="page-wrapper">
        <div class="row">
        	<div class="col-lg-6"> 
	            <div class="panel panel-default">
	                <div class="panel-heading">
	                    <i class="fa fa-warning fa-fw"></i> Deadline on 7 days later
	                </div>
	                <div class="panel-body panel-body-modified" style="padding:0px; margin:0px;">
	                	<div class="list-group">
	                		<?php
	                			if($deadline) {
		                			foreach ($deadline as $row) {
		                				echo '
		                					<a class="list-group-item" href="javascript:;" onClick="details(\''.$row->hawb_no.'\')">
				                                '.$row->hawb_no.'
				                                <span class="pull-right text-muted small"><em>'.$row->deadline.'</em>
				                                </span>
				                            </a>
		                				';		
		                			}
		                		}
	                		?>
                        </div>
                        <?php if($deadline) echo '<p class="text-center">You have '.count($deadline).' customer(s) deadline</p>'; else echo '<p class="text-center">No have data</p>'; ?>
	                </div>
	            </div>
			</div>
			<div class="col-lg-6"> 
	            <div class="panel panel-default">
	                <div class="panel-heading">
	                    <i class="fa fa-tasks fa-fw"></i> New Manifest Uploaded need Approval
	                </div>
	                <div class="panel-body panel-body-modified" style="padding:0px; margin:0px;">
	                	<div class="list-group">
                            <?php
	                			if($manifest) {
		                			foreach ($manifest as $row) {
		                				$manifest_details = $this->manifest_model->get_by_file_id($row->file_id);
		                				echo '
		                					<a class="list-group-item" href="'.base_url().'/manifest/verification?file_id='.$manifest_details->file_id.'">
				                                '.$manifest_details->mawb_no.' <span class="text-muted small"><em>Uploaded: '.$manifest_details->username.'</em></span> 
				                                <span class="pull-right text-muted small"><em>'.$manifest_details->created_date.'</em>
				                                </span>
				                            </a>
		                				';		
		                			}
		                		}
	                		?>
                        </div>
                        <?php if($manifest) echo '<p class="text-center">You have '.count($manifest).' new upload files</p>'; else echo '<p class="text-center">No have data</p>'; ?>
	                </div>
	            </div>
			</div>
			<div class="col-lg-4" style="display:none;"> 
	            <div class="chat-panel panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-comments fa-fw"></i>
                        Chat
                        <div class="btn-group pull-right">
                            <button data-toggle="dropdown" class="btn btn-default btn-xs dropdown-toggle" type="button" aria-expanded="false">
                                <i class="fa fa-chevron-down"></i>
                            </button>
                            <ul class="dropdown-menu slidedown">
                                <li>
                                    <a href="#">
                                        <i class="fa fa-refresh fa-fw"></i> Refresh
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-check-circle fa-fw"></i> Available
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-times fa-fw"></i> Busy
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-clock-o fa-fw"></i> Away
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-sign-out fa-fw"></i> Sign Out
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <ul class="chat">
                            <li class="left clearfix">
                                <span class="chat-img pull-left">
                                    <img class="img-circle" alt="User Avatar" src="http://placehold.it/50/55C1E7/fff">
                                </span>
                                <div class="chat-body clearfix">
                                    <div class="header">
                                        <strong class="primary-font">Jack Sparrow</strong>
                                        <small class="pull-right text-muted">
                                            <i class="fa fa-clock-o fa-fw"></i> 12 mins ago
                                        </small>
                                    </div>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
                                    </p>
                                </div>
                            </li>
                            <li class="right clearfix">
                                <span class="chat-img pull-right">
                                    <img class="img-circle" alt="User Avatar" src="http://placehold.it/50/FA6F57/fff">
                                </span>
                                <div class="chat-body clearfix">
                                    <div class="header">
                                        <small class=" text-muted">
                                            <i class="fa fa-clock-o fa-fw"></i> 13 mins ago</small>
                                        <strong class="pull-right primary-font">Bhaumik Patel</strong>
                                    </div>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
                                    </p>
                                </div>
                            </li>
                            <li class="left clearfix">
                                <span class="chat-img pull-left">
                                    <img class="img-circle" alt="User Avatar" src="http://placehold.it/50/55C1E7/fff">
                                </span>
                                <div class="chat-body clearfix">
                                    <div class="header">
                                        <strong class="primary-font">Jack Sparrow</strong>
                                        <small class="pull-right text-muted">
                                            <i class="fa fa-clock-o fa-fw"></i> 14 mins ago</small>
                                    </div>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
                                    </p>
                                </div>
                            </li>
                            <li class="right clearfix">
                                <span class="chat-img pull-right">
                                    <img class="img-circle" alt="User Avatar" src="http://placehold.it/50/FA6F57/fff">
                                </span>
                                <div class="chat-body clearfix">
                                    <div class="header">
                                        <small class=" text-muted">
                                            <i class="fa fa-clock-o fa-fw"></i> 15 mins ago</small>
                                        <strong class="pull-right primary-font">Bhaumik Patel</strong>
                                    </div>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
                                    </p>
                                </div>
                            </li>
                            <li class="left clearfix">
                                <span class="chat-img pull-left">
                                    <img class="img-circle" alt="User Avatar" src="http://placehold.it/50/55C1E7/fff">
                                </span>
                                <div class="chat-body clearfix">
                                    <div class="header">
                                        <strong class="primary-font">Jack Sparrow</strong>
                                        <small class="pull-right text-muted">
                                            <i class="fa fa-clock-o fa-fw"></i> 14 mins ago</small>
                                    </div>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
                                    </p>
                                </div>
                            </li>
                            <li class="right clearfix">
                                <span class="chat-img pull-right">
                                    <img class="img-circle" alt="User Avatar" src="http://placehold.it/50/FA6F57/fff">
                                </span>
                                <div class="chat-body clearfix">
                                    <div class="header">
                                        <small class=" text-muted">
                                            <i class="fa fa-clock-o fa-fw"></i> 15 mins ago</small>
                                        <strong class="pull-right primary-font">Bhaumik Patel</strong>
                                    </div>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
                                    </p>
                                </div>
                            </li>
                            <li class="left clearfix">
                                <span class="chat-img pull-left">
                                    <img class="img-circle" alt="User Avatar" src="http://placehold.it/50/55C1E7/fff">
                                </span>
                                <div class="chat-body clearfix">
                                    <div class="header">
                                        <strong class="primary-font">Jack Sparrow</strong>
                                        <small class="pull-right text-muted">
                                            <i class="fa fa-clock-o fa-fw"></i> 14 mins ago</small>
                                    </div>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
                                    </p>
                                </div>
                            </li>
                            <li class="right clearfix">
                                <span class="chat-img pull-right">
                                    <img class="img-circle" alt="User Avatar" src="http://placehold.it/50/FA6F57/fff">
                                </span>
                                <div class="chat-body clearfix">
                                    <div class="header">
                                        <small class=" text-muted">
                                            <i class="fa fa-clock-o fa-fw"></i> 15 mins ago</small>
                                        <strong class="pull-right primary-font">Bhaumik Patel</strong>
                                    </div>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
                                    </p>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!-- /.panel-body -->
                    <div class="panel-footer">
                        <div class="input-group">
                            <input type="text" placeholder="Type your message here..." class="form-control input-sm" id="btn-input">
                            <span class="input-group-btn">
                                <button id="btn-chat" class="btn btn-warning btn-sm">
                                    Send
                                </button>
                            </span>
                        </div>
                    </div>
                    <!-- /.panel-footer -->
                </div>
			</div>
            <div class="col-lg-12">  
	            <div class="panel panel-default">
	                <div class="panel-heading">
	                	<i class="fa fa-bar-chart-o fa-fw"></i>
	                    Charts
	                    <div class="pull-right">
                            <button type="button" class="btn btn-xs btn-info" data-toggle="modal" data-target="#filter-charts">Setting Charts</button>
                        </div>
	                </div>
	                <div class="panel-body" style="margin:2px 5px;padding:0px;margin-left:-15px;">
						<div class="col-lg-12"><div id="chart-container"></div></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade bs-example-modal-sm" id="filter-charts">
  <div class="modal-dialog">
    <form id="form-filter-charts" action="<?=site_url('highchart/get')?>" method="post">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Setting Charts</h4>
      </div>
      <div class="modal-body">
      <div class="row">
        <!-- <div class="col-lg-12">
          <div class="form-group">
            <label>Chart Type</label>
            <select class="form-control" name="chart_type">
                <option value="bar">Bar</option>
                <option value="pie">Pie</option>
            </select>
          </div>
        </div> -->
        <div class="col-lg-12">
          <div class="form-group">
            <label>Bussines Type</label>
            <select class="form-control" name="bussines_type">
                <option value="shipper">Shipper</option>
                <option value="consignee">Consignee</option>
            </select>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="form-group">
            <label>Status Payment</label>
            <select class="form-control" name="status_payment">
                <option value="">None</option>
                <option value="paid">Paid</option>
                <option value="unpaid">Unpaid</option>
            </select>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="form-group">
            <label>Sort By</label>
            <select class="form-control" name="sort_name">
                <option value="kg">KG</option>
                <option value="total">Total</option>
            </select>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="form-group">
            <label>&nbsp;</label>
            <select class="form-control" name="sort_by">
                <option value="asc">ASC</option>
                <option value="desc">DESC</option>
            </select>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="form-group">
            <label>From</label>
            <input class="datepicker form-control" data-date-format="mm/dd/yyyy" name="date_from">
          </div>
        </div>
        <div class="col-lg-6">
          <div class="form-group">
            <label>To</label>
            <input class="datepicker form-control" data-date-format="mm/dd/yyyy" name="date_to">
          </div>
        </div>
        <div class="col-lg-12">
          <div class="form-group">
            <label>Limit</label>
            <select class="form-control" name="limit">
                <option value="10">10</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
          </div>
        </div>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </div>
    </form>
  </div>
</div>

<script type="text/javascript">
$(document).ready(function(){
    $('#form-filter-charts select').select2();
    $('.datepicker').datepicker({
        autoclose:true
    });
    $('#form-filter-charts').ajaxSubmit({
        success:function(data){
            $('#chart-container').html(data);
            $('#filter-charts').modal('hide');
        }       
    });
    $('#form-filter-charts').ajaxForm({
        success:function(data){
            $('#chart-container').html(data);
            $('#filter-charts').modal('hide');
        }
    });
})

function details(hawb_no){
    $.colorbox({
        iframe:true,
        href:'<?=base_url()?>manifest/modal/details?hawb_no='+hawb_no,
        width:'900',
        height:'600',
        overlayClose:true,
        scrolling:true
    })
}
</script>