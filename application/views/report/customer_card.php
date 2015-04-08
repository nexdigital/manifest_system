<div id="wrapper">
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Customer Card
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <form method="get" action="<?=base_url()?>report/snow">
                            <div class="col-lg-12">
                                <div class="form-group">
                                <label>Manifest File</label>
                                    <select class="form-control" name="file_id" id="file_name">
                                        <?php
                                            if($list_file != FALSE) {
                                                foreach ($list_file as $key => $value) {
                                                    echo '<option value="'.$value->file_id.'">'.$value->mawb_no.' From: '.$value->flight_from.' - To: '.$value->flight_to.'</option>';
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-sm btn-primary find-data">Find</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if(isset($valid_file) == TRUE):?>
        <table class="table table-striped table-bordered">
            <tr>
                <td width="200px"><strong>Gross Weight</strong></td>
                <td><?=number_format($data->gross_weight)?></td>
                <td width="200px"><strong>Total Prepaid</strong></td>
                <td><?=number_format($total_pp)?></td>
            </tr>
            <tr>
                <td><strong>Total Collect</strong></td>
                <td><?=number_format($total_cc)?></td>
                <td><strong>Total Pkg</strong></td>
                <td><?=number_format($total_pkg)?></td>
            </tr>
            <tr>
                <td><strong>Total Pcs</strong></td>
                <td><?=number_format($total_pcs)?></td>
                <td><strong>Total KG</strong></td>
                <td><?=$total_kg?></td>
            </tr>
            <tr>
                <td><strong>Total Value</strong></td>
                <td><?=number_format($total_value)?></td>
                <td><strong>Other Charge Tata</strong></td>
                <td><?=number_format($total_oth_chr_tata)?></td>
            </tr>
            <tr>
                <td><strong>Other Charge PML</strong></td>
                <td><?=number_format($total_oth_chr_pml)?></td>
            </tr>
        </table>
        <table class="table table-striped table-bordered table-hover" style="font-size:10px;">
            <thead>
                <tr>
                    <th class="text-center" rowspan="3">DATE</th>
                    <th class="text-center" rowspan="3" width="150px">MAWB</th>
                    <th class="text-center" colspan="5" width="240px">G.W (KGS)</th>
                    <th class="text-center" colspan="3" width="150px">Income (NT$)</th>
                    <th class="text-center" colspan="6" width="300px">COST (NT$)</th>
                    <th class="text-center" rowspan="3">PROFIT</th>
                    <th class="text-center" rowspan="3">Debit (+)<br/> Credit (-)</th>
                </tr>
                <tr>
                    <th class="text-center" rowspan="2">HC</th>
                    <th class="text-center" rowspan="2">FTZ</th>
                    <th class="text-center" rowspan="2">PIBK</th>
                    <th class="text-center" rowspan="2">DOC FTZ</th>
                    <th class="text-center" rowspan="2">TTL</th>
                    <th class="text-center" rowspan="2">PP</th>
                    <th class="text-center" rowspan="2">CC</th>
                    <th class="text-center" rowspan="2">TTL</th>
                    <th class="text-center" colspan="2">PML</th>
                    <th class="text-center" colspan="4">TATA</th>
                <tr>
                    <th class="text-center">OTHER</th>
                    <th class="text-center">FREIGHT</th>
                    <th class="text-center">HC</th>
                    <th class="text-center">FTZ</th>
                    <th class="text-center">OTHER</th>
                    <th class="text-center">TTL</th>
                </tr>
                </tr>
            </thead>
            <tbody class="manifest-data-row">
                <tr>
                    <td class="text-center"><?=substr($data->created_date,0,10)?></td>
                    <td class="text-center"><?=$data->mawb_no?></td>
                    <td class="text-center"><input type="text" class="input-row" id="hc" style="width:35px; text-align:center;" value="<?=number_format($this->manifest_model->get_total_where('kg',$data->file_id,'mawb_type','hc'),2)?>"></td>
                    <td class="text-center"><input type="text" class="input-row" id="ftz" style="width:35px; text-align:center;" value="<?=number_format($this->manifest_model->get_total_where('kg',$data->file_id,'mawb_type','ftz'),2)?>"></td>
                    <td class="text-center"><input type="text" class="input-row" id="pibk" style="width:35px; text-align:center;" value="<?=number_format($this->manifest_model->get_total_where('kg',$data->file_id,'mawb_type','pibk'),2)?>"></td>
                    <td class="text-center"><input type="text" class="input-row" id="docftz" style="width:35px; text-align:center;" value="<?=number_format($this->manifest_model->get_count_where($data->file_id,'mawb_type','ftz'),2)?>"></td>
                    <td class="text-center"><span class="total_gw"></span></td>
                    <td class="text-center"><?=number_format($total_pp,2)?></td>
                    <td class="text-center"><?=number_format($total_pp,2)?></td>
                    <td class="text-center"><?=number_format($total_pp + $total_cc,2)?></td>
                    <td class="text-center"><?=number_format($total_oth_chr_pml,2)?></td>
                    <td class="text-center"><span class="pml_freight">0</span></td>
                    <td class="text-center"><span class="jkt_hc">0</span></td>
                    <td class="text-center"><span class="jkt_ftz">0</span></td>
                    <td class="text-center"><?=number_format($total_oth_chr_pml)?></td>
                    <td class="text-center"><span class="total_cost">0</span></td>
                    <td class="text-center"><span class="profit">0</span></td>
                    <td class="text-center"><span class="debit_credit">0</span></td>
                </tr>
            </tbody>
        </table>
        <table id="table_data" class="table table-striped table-bordered table-hover" style="font-size:10px; display:none;">
            <thead>
                <tr>
                    <th class="text-center" rowspan="3">DATE</th>
                    <th class="text-center" rowspan="3" width="150px">MAWB</th>
                    <th class="text-center" colspan="5" width="240px">G.W (KGS)</th>
                    <th class="text-center" colspan="3" width="150px">Income (NT$)</th>
                    <th class="text-center" colspan="6" width="300px">COST (NT$)</th>
                    <th class="text-center" rowspan="3">PROFIT</th>
                    <th class="text-center" rowspan="3">Debit (+)<br/> Credit (-)</th>
                </tr>
                <tr>
                    <th class="text-center" rowspan="2">HC</th>
                    <th class="text-center" rowspan="2">FTZ</th>
                    <th class="text-center" rowspan="2">PIBK</th>
                    <th class="text-center" rowspan="2">DOC FTZ</th>
                    <th class="text-center" rowspan="2">TOTAL</th>
                    <th class="text-center" rowspan="2">PP</th>
                    <th class="text-center" rowspan="2">CC</th>
                    <th class="text-center" rowspan="2">TOTAL</th>
                    <th class="text-center" colspan="2">PML</th>
                    <th class="text-center" colspan="4">TATA</th>
                <tr>
                    <th class="text-center">OTHER</th>
                    <th class="text-center">FREIGHT</th>
                    <th class="text-center">HC</th>
                    <th class="text-center">FTZ</th>
                    <th class="text-center">OTHER</th>
                    <th class="text-center">TOTAL</th>
                </tr>
                </tr>
            </thead>
            <tbody class="manifest-data-row">
                <tr>
                    <td class="text-center"><?=substr($data->created_date,0,10)?></td>
                    <td class="text-center"><?=$data->mawb_no?></td>
                    <td class="text-center"><span class="hc"></td>
                    <td class="text-center"><span class="ftz"></td>
                    <td class="text-center"><span class="pibk"></td>
                    <td class="text-center"><span class="docftz"></td>
                    <td class="text-center"><span class="total_gw"></span></td>
                    <td class="text-center"><?=number_format($total_pp,2)?></td>
                    <td class="text-center"><?=number_format($total_pp,2)?></td>
                    <td class="text-center"><?=number_format($total_pp + $total_cc,2)?></td>
                    <td class="text-center"><?=number_format($total_oth_chr_pml,2)?></td>
                    <td class="text-center"><span class="pml_freight">0</span></td>
                    <td class="text-center"><span class="jkt_hc">0</span></td>
                    <td class="text-center"><span class="jkt_ftz">0</span></td>
                    <td class="text-center"><?=number_format($total_oth_chr_pml)?></td>
                    <td class="text-center"><span class="total_cost">0</span></td>
                    <td class="text-center"><span class="profit">0</span></td>
                    <td class="text-center"><span class="debit_credit">0</span></td>
                </tr>
            </tbody>
        </table>
        <form action="<?=base_url()?>download/debit" method="post" target="_blank">
        <input type="hidden" id="data" name="data" value="">
        <button class="btn btn-primary btn-sm" id="print">Print</button>
        </form>
        <?php endif; ?>
        <div class="row pagination col-lg-12"></div>
    </div>
</div>


<script type="text/javascript">
$(document).ready(function(){
    $('input.input-row').focus(function(){
        $(this).select();
    })
    $('input.input-row').keyup(function(){
        var hc = $('#hc').val();
        var ftz = $('#ftz').val();
        var pibk = $('#pibk').val();
        var docftz = $('#docftz').val();

       $('span.hc').html(hc);
       $('span.ftz').html(ftz);
       $('span.pibk').html(pibk);
       $('span.docftz').html(docftz);


        $('input#data').val($('table#table_data').html());

        $.ajax({
            url: '<?=base_url()?>report/calc',
            type: 'POST',
            data: {'hc':hc,'ftz':ftz,'pibk':pibk,'docftz':docftz},
            dataType: 'json',
            success:function(data){
               $('span.total_gw').html(data.total_gw);
               $('span.pml_freight').html(data.pml_freight);
               $('span.jkt_hc').html(data.jkt_hc);
               $('span.jkt_ftz').html(data.jkt_hc);
               $('span.total_cost').html(data.total_cost);
               $('span.profit').html(data.profit);
               $('span.debit_credit').html(data.debit_credit);
            }
        })

    })
    $('#file_name').select2();
})
</script>