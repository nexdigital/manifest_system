<div id="wrapper">
    <div id="page-wrapper">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Verifikasi Data
                </div>
                <div class="row" style="padding:5px;">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th width="50">No</th>
                                        <th>File Name</th>
                                        <th>Upload Data</th>
                                        <th>Upload By</th>
                                        <th width="70">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="manifest-data-row">
                                    <?php
                                        if($list_file != FALSE) {
                                            $no = 1;
                                            foreach ($list_file as $key => $value) {
                                                echo '
                                                    <tr class="cursor list-file" file_id="'.$value->file_id.'">
                                                        <td>'.$no.'</td>
                                                        <td>'.$this->manifest_model->get_by_file_id($value->file_id)->file_name.'</td>
                                                        <td>'.$value->created_date.'</td>
                                                        <td>'.$this->user_model->get_by_id($value->user_id)->username.'</td>
                                                        <td> 
                                                            <div class="btn-group btn-group-xs">
                                                                <button type="button" class="btn btn-default open-file" file_id="'.$value->file_id.'">Select</button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                ';
                                                $no++;
                                            }
                                        } else {
                                            echo '
                                                    <tr>
                                                        <td colspan="4" align="center">Anda tidak memiliki daftar file yang belum di verifikasi</td>
                                                    </tr>
                                                ';
                                        }
                                    ?>
                                </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(function(){
    $('button.open-file').click(function(){
        file_id = $(this).attr('file_id');
        window.location = '<?=site_url('manifest/verification?file_id=')?>' + file_id;
    })
})
</script>