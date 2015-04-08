<?php
foreach ($result as $row) {
	echo '
	<tr>
	    <td>'.$row->hawb_no.'</td>
		<td>
		<div class="btn-group btn-group-xs">
	        <button type="button" class="btn btn-default select-search-customer" title="Select" data_id="'.$row->data_id.'">Select</button>
	    </div></td>	</tr>
	';
}
?>