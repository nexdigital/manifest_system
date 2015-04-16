<div id="page-wrapper">
    <table id="dataTable" class="table table-bordered">
        <thead>
            <tr>
                <th width="50px">Select</th>
                <th width="110px">Mawb No</th>
                <th width="110px">Hawb No</th>
                <th>Shipper</th>
                <th>Consignee</th>
                <th width="110px">Status</th>
            </tr>
        </thead>
        <tbody>
        <?php
            foreach($get_all_data as $row) {

            $shipper = $this->customers_model->get_by_id($row->shipper);
            $shipper = '<a href="javascript:;" onCLick="parent.window.location=\''.base_url().'customers/detail/'.$shipper->reference_id.'\'">'.$shipper->name.'</a><br/>
            '.ucfirst(strtolower($shipper->address)).'
            '.ucfirst($shipper->country);

            $consignee = $this->customers_model->get_by_id($row->consignee);
            $consignee = '<a href="javascript:;" onCLick="parent.window.location=\''.base_url().'customers/detail/'.$consignee->reference_id.'\'">'.$consignee->name.'</a><br/>
            '.ucfirst(strtolower($consignee->address)).'
            '.ucfirst($consignee->country);

                echo '
                <tr>
                    <td align="center" valign="middle">
                        <button type="button" class="btn btn-primary btn-xs show-details" hawb_no="'.$row->hawb_no.'">
                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                        </button>
                    </td>
                    <td align="left" valign="middle">'.$row->mawb_no.'</td>
                    <td align="left" valign="middle">'.$row->hawb_no.'</td>
                    <td align="justify">'.$shipper.'</td>
                    <td align="justify">'.$consignee.'</td>
                    <td align="justify">'.$row->status_delivery.'</td>
                </tr>
                ';
            }
        ?>
        </tbody>
    </table>
</div>


<script type="text/javascript">
$(document).ready(function(){
    $('button.show-details').click(function(){
        var hawb_no = $(this).attr('hawb_no');
        $.colorbox({
            iframe:true,
            href:'<?=base_url()?>manifest/modal/details?hawb_no='+hawb_no,
            width:'1100',
            height:'600',
            overlayClose:false,
            scrolling:true
        })
    })
})
</script>