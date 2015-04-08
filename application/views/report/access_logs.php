<script type="text/javascript" charset="utf-8">
$(document).ready(function() {
	$('#example').dataTable();
});
</script>

<div class="wrapper">
    <div id="page-wrapper">
    	
    	<table id="example" class="dataTables_wrapper form-inline table table-striped table-bordered dataTable no-footer">
    		
    		<thead>
    			<tr>
	    			<th width="100px">Date</th>
	    			<th width="100px">User ID</th>
	    			<th>URL</th>
	    			<th>IP Address</th>
	    			<th>User Agent</th>
	    		</tr>
    		</thead>
    		
    		<tbody>
    			<?php
    			foreach($access_logs as $logs) {
	    			echo '
	    			<tr>
	    				<td>'.$logs->date.'</td>
	    				<td>'.$logs->user_id.'</td>
	    				<td>'.$logs->url.'</td>
	    				<td>'.$logs->ip_address.'</td>
	    				<td>'.$logs->browser.'</td>
	    			</tr>
	    			';
	    		}
	    		?>
    		</tbody>
    		
    	</table>
    	
    </div>
</div>