<?php

if($customer != FALSE) {
	foreach($customer as $key => $row) {
		echo '
		<tr>
			<td>'.$row->name.'</td>
			<td>'.$row->address.'</td>
			<td>'.$row->city.'</td>
			<td>'.$row->country.'</td>
			<td>'.$row->phone.'</td>
			<td>'.$row->email.'</td>
			<td>

			<div class="btn-group btn-group-xs">
                <button type="button" class="btn btn-default select-similar-customer" title="Select" cust_id="'.$row->reference_id.'" data_id="'.$data_id.'" data_type="'.$type.'">Select</button>
            </div></td>
		</tr>
		';
	}
}

?>