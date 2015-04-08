<?php
foreach ($result as $row) {
	echo '
	<tr>
	    <td>'.$row->name.'</td>
	    <td>'.$row->address.'</td>
	    <td>'.$row->country.'</td>
		<td>
		<div class="btn-group btn-group-xs">
	        <button type="button" class="btn btn-default select-search-customer" title="Select" cust_id="'.$row->reference_id.'" data_type="'.$type.'">Select</button>
	    </div></td>	</tr>
	';
}
?>