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
                        <th class="text-center" rowspan="3">DATE</th>
                        <th class="text-center" rowspan="3" width="130px">MAWB</th>
                        <th class="text-center" colspan="4" width="240px">G.W (KGS)</th>
                        <th class="text-center" colspan="3" width="150px">Income (NT$)</th>
                        <th class="text-center" colspan="7" width="300px">COST (NT$)</th>
                        <th class="text-center" rowspan="3">PROFIT</th>
                        <th class="text-center" rowspan="3">TATA</th>
                        <th class="text-center" rowspan="3">LITA</th>
                        <th class="text-center" rowspan="3">PML</th>
                    </tr>
                    <tr>
                        <th class="text-center" rowspan="2">HC</th>
                        <th class="text-center" rowspan="2">FTZ</th>
                        <th class="text-center" rowspan="2">DOC FTZ</th>
                        <th class="text-center" rowspan="2">TTL</th>
                        <th class="text-center" rowspan="2">PP</th>
                        <th class="text-center" rowspan="2">CC</th>
                        <th class="text-center" rowspan="2">TTL</th>
                        <th class="text-center" colspan="2">PML</th>
                        <th class="text-center" colspan="5">TATA</th>
                    <tr>
                        <th class="text-center">OTHER</th>
                        <th class="text-center">FREIGHT</th>
                        <th class="text-center">HC</th>
                        <th class="text-center">FTZ</th>
                        <th class="text-center">OTHER</th>
                        <th class="text-center">TPE</th>
                        <th class="text-center">TTL</th>
                    </tr>
                    </tr>
                </thead>
                <tbody class="manifest-data-row">
                <?php 
                    if(count($host) > 0) {
                        foreach ($host as $key => $row) { ?>
                            <tr id="<?=strtolower(str_ireplace(array(' ','.'),'_',$row['host']))?>">
                                <td class="text-center"><div id="<?=strtolower(str_ireplace(array(' ','.'),'_',$row['host']))?>" class="date" contenteditable="false" onclick="document.execCommand('selectAll',false,null)"><?=$row['date']?></div></td>
                                <td class="text-center"><div id="<?=strtolower(str_ireplace(array(' ','.'),'_',$row['host']))?>" class="host" contenteditable="true" onclick="document.execCommand('selectAll',false,null)"><?=$row['host']?></div></td>
                                <td class="text-center"><div id="<?=strtolower(str_ireplace(array(' ','.'),'_',$row['host']))?>" class="gw_hc" contenteditable="true" onclick="document.execCommand('selectAll',false,null)"><?=$row['gw_hc']?></div></td>
                                <td class="text-center"><div id="<?=strtolower(str_ireplace(array(' ','.'),'_',$row['host']))?>" class="gw_ftz" contenteditable="true" onclick="document.execCommand('selectAll',false,null)"><?=$row['gw_ftz']?></div></td>
                                <td class="text-center"><div id="<?=strtolower(str_ireplace(array(' ','.'),'_',$row['host']))?>" class="gw_docftz" contenteditable="true" onclick="document.execCommand('selectAll',false,null)"><?=$row['gw_docftz']?></div></td>
                                <td class="text-center"><div id="<?=strtolower(str_ireplace(array(' ','.'),'_',$row['host']))?>" class="gw_total" contenteditable="false" onclick="document.execCommand('selectAll',false,null)"><?=$row['gw_total']?></div></td>
                                <td class="text-center"><div id="<?=strtolower(str_ireplace(array(' ','.'),'_',$row['host']))?>" class="in_pp" contenteditable="true" onclick="document.execCommand('selectAll',false,null)"><?=$row['in_pp']?></div></td>
                                <td class="text-center"><div id="<?=strtolower(str_ireplace(array(' ','.'),'_',$row['host']))?>" class="in_cc" contenteditable="true" onclick="document.execCommand('selectAll',false,null)"><?=$row['in_cc']?></div></td>
                                <td class="text-center"><div id="<?=strtolower(str_ireplace(array(' ','.'),'_',$row['host']))?>" class="in_total" contenteditable="false" onclick="document.execCommand('selectAll',false,null)"><?=$row['in_total']?></div></td>
                                <td class="text-center"><div id="<?=strtolower(str_ireplace(array(' ','.'),'_',$row['host']))?>" class="cost_pml_charge" contenteditable="true" onclick="document.execCommand('selectAll',false,null)"><?=$row['cost_pml_charge']?></div></td>
                                <td class="text-center"><div id="<?=strtolower(str_ireplace(array(' ','.'),'_',$row['host']))?>" class="cost_pml_freight" contenteditable="false" onclick="document.execCommand('selectAll',false,null)"><?=$row['cost_pml_freight']?></div></td>
                                <td class="text-center"><div id="<?=strtolower(str_ireplace(array(' ','.'),'_',$row['host']))?>" class="cost_tata_hc" contenteditable="false" onclick="document.execCommand('selectAll',false,null)"><?=$row['cost_tata_hc']?></div></td>
                                <td class="text-center"><div id="<?=strtolower(str_ireplace(array(' ','.'),'_',$row['host']))?>" class="cost_tata_ftz" contenteditable="false" onclick="document.execCommand('selectAll',false,null)"><?=$row['cost_tata_ftz']?></div></td>
                                <td class="text-center"><div id="<?=strtolower(str_ireplace(array(' ','.'),'_',$row['host']))?>" class="cost_tata_tpe" contenteditable="false" onclick="document.execCommand('selectAll',false,null)"><?=$row['cost_tata_tpe']?></div></td>
                                <td class="text-center"><div id="<?=strtolower(str_ireplace(array(' ','.'),'_',$row['host']))?>" class="cost_tata_charge" contenteditable="true" onclick="document.execCommand('selectAll',false,null)"><?=$row['cost_tata_charge']?></div></td>
                                <td class="text-center"><div id="<?=strtolower(str_ireplace(array(' ','.'),'_',$row['host']))?>" class="cost_total" contenteditable="false" onclick="document.execCommand('selectAll',false,null)"><?=$row['cost_total']?></div></td>
                                <td class="text-center"><div id="<?=strtolower(str_ireplace(array(' ','.'),'_',$row['host']))?>" class="profit" contenteditable="false" onclick="document.execCommand('selectAll',false,null)"><?=$row['profit']?></div></td>
                                <td class="text-center"><div id="<?=strtolower(str_ireplace(array(' ','.'),'_',$row['host']))?>" class="tata" contenteditable="false" onclick="document.execCommand('selectAll',false,null)"><?=$row['tata']?></div></td>
                                <td class="text-center"><div id="<?=strtolower(str_ireplace(array(' ','.'),'_',$row['host']))?>" class="lita" contenteditable="false" onclick="document.execCommand('selectAll',false,null)"><?=$row['lita']?></div></td>
                                <td class="text-center"><div id="<?=strtolower(str_ireplace(array(' ','.'),'_',$row['host']))?>" class="pml" contenteditable="false" onclick="document.execCommand('selectAll',false,null)"><?=$row['pml']?></div></td>
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
                date:$(this).find('.date').html(),
                host:$(this).find('.host').html(),
                gw_hc:$(this).find('.gw_hc').html(),
                gw_ftz:$(this).find('.gw_ftz').html(),
                gw_docftz:$(this).find('.gw_docftz').html(),
                gw_total:$(this).find('.gw_total').html(),
                in_pp:$(this).find('.in_pp').html(),
                in_cc:$(this).find('.in_cc').html(),
                in_total:$(this).find('.in_total').html(),
                cost_pml_charge:$(this).find('.cost_pml_charge').html(),
                cost_pml_freight:$(this).find('.cost_pml_freight').html(),
                cost_tata_hc:$(this).find('.cost_tata_hc').html(),
                cost_tata_ftz:$(this).find('.cost_tata_ftz').html(),
                cost_tata_charge:$(this).find('.cost_tata_charge').html(),
                cost_tata_tpe:$(this).find('.cost_tata_tpe').html(),
                cost_total:$(this).find('.cost_total').html(),
                profit:$(this).find('.profit').html(),
                tata:$(this).find('.tata').html(),
                lita:$(this).find('.lita').html(),
                pml:$(this).find('.pml').html(),
            });
        })

        if(data.length  == 0) {
            alert('You no have data to print');
        } else {
            $.post('<?=base_url()?>download/excel',{'snow':'vietnam','data':data},function(url){
                window.open(url,'_blank');
            });
        }
    })

    $('#add_row').click(function(){
        var row_id = get_id();


        var element = '<tr id="' + row_id + '">';
        element += '<td class="text-center"><div contenteditable="false" onclick="document.execCommand("selectAll",false,null)" class="date" id="' + row_id + '"></div></td>';
        element += '<td class="text-center"><div contenteditable="true" onclick="document.execCommand("selectAll",false,null)" class="host" id="' + row_id + '"></div></td>';
        element += '<td class="text-center"><div contenteditable="true" onclick="document.execCommand("selectAll",false,null)" class="gw_hc" id="' + row_id + '"></div></td>';
        element += '<td class="text-center"><div contenteditable="true" onclick="document.execCommand("selectAll",false,null)" class="gw_ftz" id="' + row_id + '"></div></td>';
        element += '<td class="text-center"><div contenteditable="true" onclick="document.execCommand("selectAll",false,null)" class="gw_docftz" id="' + row_id + '"></div></td>';
        element += '<td class="text-center"><div contenteditable="false" onclick="document.execCommand("selectAll",false,null)" class="gw_total" id="' + row_id + '"></div></td>';
        element += '<td class="text-center"><div contenteditable="true" onclick="document.execCommand("selectAll",false,null)" class="in_pp" id="' + row_id + '"></div></td>';
        element += '<td class="text-center"><div contenteditable="true" onclick="document.execCommand("selectAll",false,null)" class="in_cc" id="' + row_id + '"></div></td>';
        element += '<td class="text-center"><div contenteditable="false" onclick="document.execCommand("selectAll",false,null)" class="in_total" id="' + row_id + '"></div></td>';
        element += '<td class="text-center"><div contenteditable="true" onclick="document.execCommand("selectAll",false,null)" class="cost_pml_charge" id="' + row_id + '"></div></td>';
        element += '<td class="text-center"><div contenteditable="false" onclick="document.execCommand("selectAll",false,null)" class="cost_pml_freight" id="' + row_id + '"></div></td>';
        element += '<td class="text-center"><div contenteditable="false" onclick="document.execCommand("selectAll",false,null)" class="cost_tata_hc" id="' + row_id + '"></div></td>';
        element += '<td class="text-center"><div contenteditable="false" onclick="document.execCommand("selectAll",false,null)" class="cost_tata_ftz" id="' + row_id + '"></div></td>';
        element += '<td class="text-center"><div contenteditable="true" onclick="document.execCommand("selectAll",false,null)" class="cost_tata_charge" id="' + row_id + '"></div></td>';
        element += '<td class="text-center"><div contenteditable="false" onclick="document.execCommand("selectAll",false,null)" class="cost_tata_tpe" id="' + row_id + '"></div></td>';
        element += '<td class="text-center"><div contenteditable="false" onclick="document.execCommand("selectAll",false,null)" class="cost_total" id="' + row_id + '"></div></td>';
        element += '<td class="text-center"><div contenteditable="false" onclick="document.execCommand("selectAll",false,null)" class="profit" id="' + row_id + '"></div></td>';
        element += '<td class="text-center"><div contenteditable="false" onclick="document.execCommand("selectAll",false,null)" class="tata" id="' + row_id + '"></div></td>';
        element += '<td class="text-center"><div contenteditable="false" onclick="document.execCommand("selectAll",false,null)" class="lita" id="' + row_id + '"></div></td>';
        element += '<td class="text-center"><div contenteditable="false" onclick="document.execCommand("selectAll",false,null)" class="pml" id="' + row_id + '"></div></td>';
        element += '</tr>';
        $('tbody.manifest-data-row').append(element);
    })

    $('div.gw_hc, div.gw_ftz, div.in_pp, div.in_cc, div.cost_pml_charge, div.cost_tata_charge').live('blur',function(){
        var host_id = $(this).attr('id');

        var gw_hc               = $('tr#' + host_id).find('.gw_hc').html();
        var gw_ftz              = $('tr#' + host_id).find('.gw_ftz').html();
        var gw_docftz           = $('tr#' + host_id).find('.gw_docftz').html();
        var gw_total            = $('tr#' + host_id).find('.gw_total').html();
        var in_pp               = $('tr#' + host_id).find('.in_pp').html();
        var in_cc               = $('tr#' + host_id).find('.in_cc').html();
        var in_total            = $('tr#' + host_id).find('.in_total').html();
        var cost_pml_charge     = $('tr#' + host_id).find('.cost_pml_charge').html();
        var cost_pml_freight    = $('tr#' + host_id).find('.cost_pml_freight').html();
        var cost_tata_hc        = $('tr#' + host_id).find('.cost_tata_hc').html();
        var cost_tata_ftz       = $('tr#' + host_id).find('.cost_tata_ftz').html();
        var cost_tata_tpe       = $('tr#' + host_id).find('.cost_tata_tpe').html();
        var cost_tata_charge    = $('tr#' + host_id).find('.cost_tata_charge').html();
        var cost_total          = $('tr#' + host_id).find('.cost_total').html();
        var profit              = $('tr#' + host_id).find('.profit').html();
        var tata                = $('tr#' + host_id).find('.tata').html();
        var lita                = $('tr#' + host_id).find('.lita').html();
        var pml                 = $('tr#' + host_id).find('.pml').html();

        $.ajax({
            url: '<?=base_url()?>report/calc',
            type: 'POST',
            data: {'snow':'vietnam','host':host_id, 'gw_hc': gw_hc, 'gw_ftz':gw_ftz, 'gw_docftz':gw_docftz, 'in_pp':in_pp, 'in_cc':in_cc, 'cost_pml_charge':cost_pml_charge, 'cost_tata_charge':cost_tata_charge},
            dataType: 'JSON',
            success: function(data) {
                $('tr#' + host_id).find('.gw_total').html(data.gw_total);
                $('tr#' + host_id).find('.in_total').html(data.in_total);
                $('tr#' + host_id).find('.cost_pml_freight').html(data.cost_pml_freight);
                $('tr#' + host_id).find('.cost_tata_hc').html(data.cost_tata_hc);
                $('tr#' + host_id).find('.cost_tata_ftz').html(data.cost_tata_ftz);
                $('tr#' + host_id).find('.cost_tata_tpe').html(data.cost_tata_tpe);
                $('tr#' + host_id).find('.cost_total').html(data.cost_total);
                $('tr#' + host_id).find('.profit').html(data.profit);
                $('tr#' + host_id).find('.tata').html(data.tata);
                $('tr#' + host_id).find('.lita').html(data.lita);
                $('tr#' + host_id).find('.pml').html(data.pml);
            }
        })
    })

})

function get_id(){
    var d = new Date();
    return d.getTime(); 
}
</script>