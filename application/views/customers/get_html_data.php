<?php
    if($customer != false) {
        $no = 1;
        foreach ($customer as $key => $row) {
            echo '
            <tr>
                <td>'.$row->cust_id.'</td>
                <td>'.wordwrap(str_ireplace('_x000D_', ' ', $row->address)).'</td>
                <td>
                    <div class="btn-group btn-group-xs">
                        <button type="button" class="btn btn-default">Details</button>
                        <button type="button" class="btn btn-default">Edit</button>
                        <button type="button" class="btn btn-default">Print</button>
                    </div>
                </td>
            </tr>
            ';
            $no++;
        }
    } else {
        echo '
        <tr>
            <td colspan="13" align="center">No found data</td>
        </tr>
        ';
    }
?>
