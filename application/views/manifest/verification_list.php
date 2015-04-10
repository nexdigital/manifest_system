<div id="page-wrapper">
    <table id="dataTable" class="table table-bordered">
        <thead>
            <tr>
                <th width="50px">Select</th>
                <th>Filename</th>
                <th width="75px">Total Data</th>
                <th width="75px">Verified</th>
                <th width="80px">Not Verified</th>
                <th width="85px">Upload date</th>
                <th width="80px">Upload By</th>
            </tr>
        </thead>

        <tbody>
            <?php
                foreach ($get_file_not_verified as $key => $row) {
                    echo '
                    <tr>
                        <td align="center">
                            <button type="button" class="btn btn-primary btn-xs" onCLick="window.location = \''.site_url('manifest/verification?file_id='.$row->file_id).'\'">
                                <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                            </button>
                        </td>
                        <td>'.$row->file_name.'</td>
                        <td align="center">'.$row->total_data.'</td>
                        <td align="center">'.$row->verified.'</td>
                        <td align="center">'.$row->not_verified.'</td>
                        <td>'.substr($row->created_date,0,10).'</td>
                        <td>'.$row->user_id.'</td>
                    </tr>
                    ';
                }
            ?>
        </tbody>
    </table>
</div>