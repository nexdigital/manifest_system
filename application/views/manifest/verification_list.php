<div id="wrapper">
    <div id="page-wrapper">
        <table id="jqGrid"></table>
        <div id="jqGridBar"></div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function(){
    jQuery("#jqGrid").jqGrid({ 
        url:'<?=site_url('manifest/ajax/get_verification_list')?>', 
        datatype: "json",
        colNames:['Filename','Consign To', 'Mawb No', 'Flight From', 'Flight To','Gross Weight','Upload Date','User','Select'], 
        colModel:[
            {name:'file_name', index:'filename', width:200, align:'left'}, 
            {name:'consign_to', index:'consign_to', width:100},
            {name:'mawb_no', index:'mawb_no', width:120},
            {name:'flight_from', index:'flight_from', width:120},
            {name:'flight_to', index:'flight_to', width:120},
            {name:'gross_weight', index:'gross_weight', width:70},
            {name:'created_date', index:'created_date', width:120},
            {name:'username', index:'user', width:120},
            {name:'Select',search:false,index:'data_id',width:70,sortable: false,formatter: action, align:'center'},
        ],
        shrinkToFit: true,
        rowTotal: <?=count($this->manifest_model->get_filtering_data(null,null,array('D.status' => 'Unverified'),'D.file_id'))?>,
        height:300,
        rowNum:100,
        loadonce:true, 
        mtype: "POST", 
        pager: '#jqGridBar',
        caption: "List Manifest Unveryfication"
    }); 
    jQuery("#jqGrid").jqGrid('filterToolbar',{stringResult: true,searchOnEnter : false});
})

function action(val,options,rowdata,action) {
    return '<a href="javascript:;" onCLick="details(\'' + rowdata.file_id + '\')">Select</a>';
}
function details(file_id){
    window.location = '<?=site_url()?>manifest/verification?file_id=' + file_id;
}
</script>