<style type="text/css">

div[contenteditable=true] {
    border:1px solid #ccc;
    min-height: 18px;
}

</style>

<div id="wrapper">
    <div id="page-wrapper">
        <div class="row">
            <strong>Keterangan:</strong>
            <p>Jika angka dalam ribu di tulis: 1000 tidak menggunakan titik (.) atau koma (,)</p>
            <p>Untuk angka seperti 0.00 menggunakan titik (.)</p>

            <table id="table_data" class="table table-striped table-bordered table-hover" style="font-size:10px;">
                <thead>
                    <tr>
                        <th class="text-center" rowspan="3" width="130px">DATE</th>
                        <th class="text-center" rowspan="3" width="130px">MAWB</th>
                        <th class="text-center" colspan="2">G.W (KGS)</th>
                        <th class="text-center" colspan="3">Income (NT$)</th>
                        <th class="text-center" colspan="5">COST (NT$)</th>
                        <th class="text-center" rowspan="3">PROFIT</th>
                        <th class="text-center" rowspan="3">CREDIT DUE TO TATA</th>
                        <th class="text-center" rowspan="3">CREDIT DUE TO PML</th>
                        <th class="text-center" colspan="3" width="150px">ACU ACCONT</th>
                    </tr>
                    <tr>
                        <th class="text-center" rowspan="2">SELLING</th>
                        <th class="text-center" rowspan="2">MAWB</th>
                        <th class="text-center" rowspan="2">PP</th>
                        <th class="text-center" rowspan="2">CC</th>
                        <th class="text-center" rowspan="2">TTL</th>
                        <th class="text-center" colspan="2">TATA</th>
                        <th class="text-center" colspan="3">PML</th>
                        <th class="text-center" rowspan="2">TOTAL CC</th>
                        <th class="text-center" rowspan="2">COST</th>
                        <th class="text-center" rowspan="2">REFUND TO MS ACU</th>
                    <tr>
                        <th class="text-center">OTHER</th>
                        <th class="text-center">FREIGHT</th>
                        <th class="text-center">HANDLING</th>
                        <th class="text-center">OTHER</th>
                        <th class="text-center">TTL</th>
                    </tr>
                    </tr>
                </thead>
                <tbody class="manifest-data-row">
                <?php 
                    if(count($host) > 0) {
                        foreach ($host as $key => $row) { ?>
                            <tr id="<?=strtolower(str_ireplace(array(' ','.'),'_',$row['host']))?>" snow_type="<?=$row['snow_type']?>">
                                <td class="text-center"><div id="<?=strtolower(str_ireplace(array(' ','.'),'_',$row['host']))?>" class="date" contenteditable="false" onclick="document.execCommand('selectAll',false,null)"><?=$row['date']?></div></td>
                                <td class="text-center"><div id="<?=strtolower(str_ireplace(array(' ','.'),'_',$row['host']))?>" class="host" contenteditable="false" onclick="document.execCommand('selectAll',false,null)"><?=$row['host']?></div></td>
                                <td class="text-center"><div id="<?=strtolower(str_ireplace(array(' ','.'),'_',$row['host']))?>" class="gw_selling" contenteditable="false" onclick="document.execCommand('selectAll',false,null)"><?=$row['gw_selling']?></div></td>
                                <td class="text-center"><div id="<?=strtolower(str_ireplace(array(' ','.'),'_',$row['host']))?>" class="gw_mawb" contenteditable="true" onclick="document.execCommand('selectAll',false,null)"><?=$row['gw_mawb']?></div></td>
                                <td class="text-center"><div id="<?=strtolower(str_ireplace(array(' ','.'),'_',$row['host']))?>" class="in_pp" contenteditable="true" onclick="document.execCommand('selectAll',false,null)"><?=$row['in_pp']?></div></td>
                                <td class="text-center"><div id="<?=strtolower(str_ireplace(array(' ','.'),'_',$row['host']))?>" class="in_cc" contenteditable="true" onclick="document.execCommand('selectAll',false,null)"><?=$row['in_cc']?></div></td>
                                <td class="text-center"><div id="<?=strtolower(str_ireplace(array(' ','.'),'_',$row['host']))?>" class="in_total" contenteditable="false" onclick="document.execCommand('selectAll',false,null)"><?=$row['in_total']?></div></td>
                                <td class="text-center"><div id="<?=strtolower(str_ireplace(array(' ','.'),'_',$row['host']))?>" class="cost_tata_charge" contenteditable="true" onclick="document.execCommand('selectAll',false,null)"><?=$row['cost_tata_charge']?></div></td>
                                <td class="text-center"><div id="<?=strtolower(str_ireplace(array(' ','.'),'_',$row['host']))?>" class="cost_tata_freight" contenteditable="false" onclick="document.execCommand('selectAll',false,null)"><?=$row['cost_tata_freight']?></div></td>
                                <td class="text-center"><div id="<?=strtolower(str_ireplace(array(' ','.'),'_',$row['host']))?>" class="cost_pml_handling" contenteditable="false" onclick="document.execCommand('selectAll',false,null)"><?=$row['cost_pml_handling']?></div></td>
                                <td class="text-center"><div id="<?=strtolower(str_ireplace(array(' ','.'),'_',$row['host']))?>" class="cost_pml_charge" contenteditable="true" onclick="document.execCommand('selectAll',false,null)"><?=$row['cost_pml_charge']?></div></td>
                                <td class="text-center"><div id="<?=strtolower(str_ireplace(array(' ','.'),'_',$row['host']))?>" class="cost_total" contenteditable="false" onclick="document.execCommand('selectAll',false,null)"><?=$row['cost_total']?></div></td>
                                <td class="text-center"><div id="<?=strtolower(str_ireplace(array(' ','.'),'_',$row['host']))?>" class="profit" contenteditable="false" onclick="document.execCommand('selectAll',false,null)"><?=$row['profit']?></div></td>
                                <td class="text-center"><div id="<?=strtolower(str_ireplace(array(' ','.'),'_',$row['host']))?>" class="credit_to_ths" contenteditable="false" onclick="document.execCommand('selectAll',false,null)"><?=$row['credit_to_ths']?></div></td>
                                <td class="text-center"><div id="<?=strtolower(str_ireplace(array(' ','.'),'_',$row['host']))?>" class="credit_to_pml" contenteditable="false" onclick="document.execCommand('selectAll',false,null)"><?=$row['credit_to_pml']?></div></td>
                                <td class="text-center"><div id="<?=strtolower(str_ireplace(array(' ','.'),'_',$row['host']))?>" class="acu_total_cc" contenteditable="false" onclick="document.execCommand('selectAll',false,null)"><?=$row['acu_total_cc']?></div></td>
                                <td class="text-center"><div id="<?=strtolower(str_ireplace(array(' ','.'),'_',$row['host']))?>" class="acu_cost" contenteditable="false" onclick="document.execCommand('selectAll',false,null)"><?=$row['acu_cost']?></div></td>
                                <td class="text-center"><div id="<?=strtolower(str_ireplace(array(' ','.'),'_',$row['host']))?>" class="acu_refund" contenteditable="false" onclick="document.execCommand('selectAll',false,null)"><?=$row['acu_refund']?></div></td>
                            </tr>                
                <?php } } ?>
            </tbody>
            </table>

            <div class="btn-group">
                <!-- <button class="btn btn-default btn-sm" id="print_pdf">Print Pdf</button> -->
                <button class="btn btn-default btn-sm" id="print_excel">Print Excel</button>
                <button class="btn btn-default btn-sm" id="add_row">Add Row</button>
            </div>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function(){
    $('input#data').val($('table#table_data').html());

    $('div.gw_hc, div.gw_ftz, div.in_pp, div.in_cc, div.cost_pml_charge, div.cost_tata_charge').focus(function(){
        document.execCommand('selectAll',false,null);
    })

    $('#print_excel').click(function(){
        data = [];
        $('tbody tr').each(function(){
            data.push({
                date: $(this).find('.date').html(),
                host: $(this).find('.host').html(),
                snow_type:$(this).attr('snow_type'),
                gw_selling: $(this).find('.gw_selling').html(),
                gw_mawb: $(this).find('.gw_mawb').html(),
                in_pp: $(this).find('.in_pp').html(),
                in_cc: $(this).find('.in_cc').html(),
                in_total: $(this).find('.in_total').html(),
                cost_tata_charge: $(this).find('.cost_tata_charge').html(),
                cost_tata_freight: $(this).find('.cost_tata_freight').html(),
                cost_pml_handling: $(this).find('.cost_pml_handling').html(),
                cost_pml_charge: $(this).find('.cost_pml_charge').html(),
                cost_total: $(this).find('.cost_total').html(),
                profit: $(this).find('.profit').html(),
                credit_to_ths: $(this).find('.credit_to_ths').html(),
                credit_to_pml: $(this).find('.credit_to_pml').html(),
                acu_total_cc: $(this).find('.acu_total_cc').html(),
                acu_cost: $(this).find('.acu_cost').html(),
                acu_refund: $(this).find('.acu_refund').html()
            });
        })
    
        if(data.length  == 0) {
            alert('You no have data to print');
        } else {
            $.post('<?=base_url()?>download/excel',{'snow':'jakarta_taiwan','data':data},function(url){
                window.open(url,'_blank');
            });
        }
    })

    $('#add_row').click(function(){
        var host_id = get_id();

        var element = '<tr id="' + host_id + '" snow_type="jkt_tw">';
        element += '<td class="text-center"><div id="' + host_id + '" class="date" contenteditable="false" onclick="document.execCommand("selectAll",false,null)"></div></td>';
        element += '<td class="text-center"><div id="' + host_id + '" class="host" contenteditable="true" onclick="document.execCommand("selectAll",false,null)"></div></td>';
        element += '<td class="text-center"><div id="' + host_id + '" class="gw_selling" contenteditable="true" onclick="document.execCommand("selectAll",false,null)"></div></td>';
        element += '<td class="text-center"><div id="' + host_id + '" class="gw_mawb" contenteditable="true" onclick="document.execCommand("selectAll",false,null)"></div></td>';
        element += '<td class="text-center"><div id="' + host_id + '" class="in_pp" contenteditable="true" onclick="document.execCommand("selectAll",false,null)"></div></td>';
        element += '<td class="text-center"><div id="' + host_id + '" class="in_cc" contenteditable="true" onclick="document.execCommand("selectAll",false,null)"></div></td>';
        element += '<td class="text-center"><div id="' + host_id + '" class="in_total" contenteditable="false" onclick="document.execCommand("selectAll",false,null)"></div></td>';
        element += '<td class="text-center"><div id="' + host_id + '" class="cost_tata_charge" contenteditable="true" onclick="document.execCommand("selectAll",false,null)"></div></td>';
        element += '<td class="text-center"><div id="' + host_id + '" class="cost_tata_freight" contenteditable="false" onclick="document.execCommand("selectAll",false,null)"></div></td>';
        element += '<td class="text-center"><div id="' + host_id + '" class="cost_pml_handling" contenteditable="false" onclick="document.execCommand("selectAll",false,null)"></div></td>';
        element += '<td class="text-center"><div id="' + host_id + '" class="cost_pml_charge" contenteditable="false" onclick="document.execCommand("selectAll",false,null)"></div></td>';
        element += '<td class="text-center"><div id="' + host_id + '" class="cost_total" contenteditable="false" onclick="document.execCommand("selectAll",false,null)"></div></td>';
        element += '<td class="text-center"><div id="' + host_id + '" class="profit" contenteditable="false" onclick="document.execCommand("selectAll",false,null)"></div></td>';
        element += '<td class="text-center"><div id="' + host_id + '" class="credit_to_ths" contenteditable="false" onclick="document.execCommand("selectAll",false,null)"></div></td>';
        element += '<td class="text-center"><div id="' + host_id + '" class="credit_to_pml" contenteditable="false" onclick="document.execCommand("selectAll",false,null)"></div></td>';
        element += '<td class="text-center"><div id="' + host_id + '" class="acu_total_cc" contenteditable="false" onclick="document.execCommand("selectAll",false,null)"></div></td>';
        element += '<td class="text-center"><div id="' + host_id + '" class="acu_cost" contenteditable="false" onclick="document.execCommand("selectAll",false,null)"></div></td>';
        element += '<td class="text-center"><div id="' + host_id + '" class="acu_refund" contenteditable="false" onclick="document.execCommand("selectAll",false,null)"></div></td>';
        $('tbody.manifest-data-row').append(element);
    })

    $('div.gw_selling, div.gw_mawb, div.in_pp, div.in_cc, div.cost_tata_charge').live('blur',function(){
        var host_id = $(this).attr('id');
        var snow_type = $('tr#' + host_id).attr('snow_type');

        var gw_selling = $('tr#' + host_id).find('.gw_selling').html();
        var gw_mawb = $('tr#' + host_id).find('.gw_mawb').html();
        var in_pp = $('tr#' + host_id).find('.in_pp').html();
        var in_cc = $('tr#' + host_id).find('.in_cc').html();
        var cost_tata_charge = $('tr#' + host_id).find('.cost_tata_charge').html();
        var cost_pml_charge =  $('tr#' + host_id).find('.cost_pml_charge').html();

        $.ajax({
            url: '<?=base_url()?>report/calc',
            type: 'POST',
            data: {'snow':'jakarta_taiwan','snow_type':snow_type,'host':host_id, 'gw_selling': gw_selling, 'gw_mawb':gw_mawb, 'in_pp':in_pp, 'in_cc':in_cc, 'cost_tata_charge':cost_tata_charge, 'cost_pml_charge':cost_pml_charge},
            dataType: 'JSON',
            success: function(data) {
                $('tr#' + host_id).find('.in_total').html(data.in_total);
                $('tr#' + host_id).find('.cost_tata_freight').html(data.cost_tata_freight);
                $('tr#' + host_id).find('.cost_pml_handling').html(data.cost_pml_handling);
                $('tr#' + host_id).find('.cost_total').html(data.cost_total);
                $('tr#' + host_id).find('.profit').html(data.profit);
                $('tr#' + host_id).find('.credit_to_ths').html(data.credit_to_ths);
                $('tr#' + host_id).find('.credit_to_pml').html(data.credit_to_pml);
                $('tr#' + host_id).find('.acu_total_cc').html(data.acu_total_cc);
                $('tr#' + host_id).find('.acu_cost').html(data.acu_cost);
                $('tr#' + host_id).find('.acu_refund').html(data.acu_refund);
            }
        })
    })

})

function get_id(){
    var d = new Date();
    return d.getTime(); 
}
</script>