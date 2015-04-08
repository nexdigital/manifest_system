<div id="wrapper">
    <div id="page-wrapper">
        <table id="jqGrid"></table>
        <div id="jqGridBar"></div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function(){
    jQuery("#jqGrid").jqGrid({ 
        url:'<?=site_url('manifest/ajax/get')?>', 
        datatype: "json",
        colNames:['Hawb No','Shipper', 'Consginee', 'Pkg', 'Pcs','Kg','Value','Prepaid','Collect','Kurs','Type','Status','Details'], 
        colModel:[
            {name:'hawb_no', index:'hawb_no', width:100, align:'center'}, 
            {name:'shipper', index:'shipper', width:300},
            {name:'consignee', index:'consignee', width:300},
            {name:'pkg', index:'pkg', width:70, align:'center'},
            {name:'pcs', index:'pcs', width:70, align:'center'},
            {name:'kg', index:'kg', width:70, align:'center'},
            {name:'value', index:'value', width:70, align:'center'},
            {name:'prepaid', index:'prepaid', width:70, align:'center'},
            {name:'collect', index:'collect', width:70, align:'center'},
            {name:'nt_kurs', index:'nt_kurs', width:70, align:'center'},
            {name:'manifest_type', index:'manifest_type', width:70, align:'center'},
            {name:'status_delivery', index:'status_delivery', width:70, align:'center'},
            {name:'Details',search:false,index:'hawb_no',width:70,sortable: false,formatter: action, align:'center'},
        ],
        shrinkToFit: true,
        rowTotal: <?=count($this->manifest_model->get_filtering_data(null,null,array('D.status' => 'VALID')))?>,
        height:300,
        rowNum:100,
        loadonce:true, 
        mtype: "POST", 
        pager: '#jqGridBar',
        caption: "Manifest Data"
    }); 
    jQuery("#jqGrid").jqGrid('filterToolbar',{stringResult: true,searchOnEnter : false});
})

function action(val,options,rowdata,action) {
    return '<a href="javascript:;" onCLick="details(\'' + rowdata.hawb_no + '\')">Select</a>';
}
function details(hawb_no){
    $.colorbox({
        iframe:true,
        href:'<?=base_url()?>manifest/modal/details?hawb_no='+hawb_no,
        width:'900',
        height:'600',
        overlayClose:true,
        scrolling:true
    })
}
</script>