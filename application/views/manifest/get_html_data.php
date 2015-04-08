<?php
    if($manifest != false) {
        $no = 1;
        foreach ($manifest as $key => $row) {
            echo '
            <tr>
                <td>'.$row->data_no.'</td>
                <td>'.$row->hawb_no.'</td>
                <td>';
                $shipper = $this->customers_model->get_by_id($row->shipper);
                if($shipper != FALSE) {                                                
                    echo '
                        <strong>'.$shipper->name.'</strong><br/>
                        '.$shipper->address.'<br/>
                        '.$shipper->country;
                } else echo '<span class="label label-danger">Data Belum di Verifikasi</span>';
                echo '</td>
                <td>';
                $consginee = $this->customers_model->get_by_id($row->consignee);
                if($shipper != FALSE) {                                                
                    echo '
                        <strong>'.$consginee->name.'</strong><br/>
                        '.$consginee->address.'<br/>
                        '.$consginee->country;
                } else echo '<span class="label label-danger">Data Belum di Verifikasi</span>';
                echo '</td>
                <td>'.$row->pkg.'</td>
                <td>'.$row->description.'</td>
                <td>'.$row->pcs.'</td>
                <td>'.$row->kg.'</td>
                <td>'.$row->value.'</td>
                <td>'.$row->prepaid.'</td>
                <td>'.$row->collect.'</td>
                <td>'.$row->remarks.'</td>
                <td>
                    <div class="btn-group btn-group-xs">
                        <button type="button" class="btn btn-default" title="Details" onCLick="details(\''.$row->data_id.'\')"><span class="glyphicon glyphicon-search"></span></button>
                        <button type="button" class="btn btn-default" title="Edit" onCLick="edit(\''.$row->data_id.'\')"><span class="glyphicon glyphicon-edit"></span></button>
                        <button type="button" class="btn btn-default" title="Print" onCLick="print(\''.$row->data_id.'\')"><span class="glyphicon glyphicon-print"></span></button>
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
